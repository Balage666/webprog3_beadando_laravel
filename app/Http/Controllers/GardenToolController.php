<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\GardenTool;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GardenToolController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function Create()
    {
        return view('gardentool.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function Store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'stock' => ['required', 'gt:0'],
            'price' => ['required', 'gt:450'],
            'image' => ['mimes:png,jpg'],
        ]);

        // dd($request);

        if ($request['description']) {
            $formFields['description'] = $request['description'];
        } else {
            $formFields['description'] = 'Sample Description';
        }

        // dd($request->file('image'));

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('/uploads', 'public');
            $formFields['image'] = '/storage/'.$formFields['image'];
        } else {
            $formFields['image'] = '/assets/media/gardentools/def_market_gardener.png';
        }

        // dd($formFields['image']);

        GardenTool::create($formFields);

        return redirect('/admin')->with('message', 'A new tool has been successfully added!');
    }

    /**
     * Display the specified resource.
     */
    public function Show(GardenTool $GardenTool)
    {
        return view('gardentool.show', ['gardenTool' => $GardenTool]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function Edit(GardenTool $GardenTool)
    {
        // dd($GardenTool);
        return view('gardentool.edit', ['gardenTool' => $GardenTool]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function Update(Request $request, GardenTool $GardenTool)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'stock' => ['required', 'gt:0'],
            'price' => ['required', 'gt:450'],
            'image' => ['mimes:png,jpg'],
        ]);

        $formFields['description'] = $request['description'];

        // dd($request->hasFile('image'));

        if ($request->hasFile('image')) {

            $formFields['image'] = $request->file('image')->store('/uploads', 'public');
            $formFields['image'] = '/storage/'.$formFields['image'];

            $temp = ltrim($GardenTool->image, '/storage/');
            if (file_exists(public_path('/storage/'.$temp))) {
                unlink(public_path($GardenTool->image));
            }
        } else {

            $formFields['image'] = $GardenTool->image;
        }

        $GardenTool->name = $formFields['name'];
        $GardenTool->description = $formFields['description'];
        $GardenTool->stock = $formFields['stock'];
        $GardenTool->price = $formFields['price'];
        $GardenTool->image = $formFields['image'];

        $GardenTool['updated_at'] = now('Europe/Budapest');

        // dd($formFields, $GardenTool);

        $GardenTool->save();

        return redirect('/admin')->with('message', 'Item has been succesfully updated!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function Destroy(GardenTool $GardenTool)
    {
        $temp = ltrim($GardenTool->image, '/storage/');
        $GardenTool->delete();
        if (file_exists(public_path('/storage/'.$temp))) {
            unlink(public_path('/storage/'.$temp));
        }

        return redirect('/admin')->with('message', 'Tool has been deleted!');

    }

    public function ViewCart(Request $request) {

        if (! $request->session()->has('cart')) {
            return view('gardentool.cart');
        }

        $oldCart = $request->session()->get('cart');
        $cart = new Cart($oldCart);

        return view('gardentool.cart',
            ['CartContent' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function AddToCart(Request $request, GardenTool $GardenTool)
    {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);

        if ($GardenTool->stock < 1) {
            return redirect('/')->with('add-to-cart-failed', 'This product is out of stock');
        }

        $cart->Add($GardenTool, $GardenTool->id);

        $request->session()->put('cart', $cart);
        // dd($request->session()->get('cart'));

        return redirect('/');
    }

    public function ReduceByOne(Request $request, GardenTool $GardenTool) {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->ReduceByOne($GardenTool->id);

        if (count($cart->items) > 0) {
            $request->session()->put('cart', $cart);
        } else {
            $request->session()->forget('cart');
        }

        return redirect('/cart/view');
    }

    public function RemoveItem(Request $request, GardenTool $GardenTool)
    {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->RemoveItem($GardenTool->id);

        if (count($cart->items) > 0) {
            $request->session()->put('cart', $cart);
        } else {
            $request->session()->forget('cart');
        }

        return redirect('/cart/view');
    }

    public function ClearCart(Request $request)
    {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);

        $request->session()->forget('cart');

        return redirect('/cart/view');
    }

    public function CheckOut(Request $request) {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);

        return view('gardentool.checkout', ['Cart' => $cart]);
    }

    public function ProcessCheckOut(Request $request) {

        $oldCart = $request->session()->get('cart');
        $cart = new Cart($oldCart);

        $formFields = $request->validate([
            'first_name' => ['required', 'min:3'],
            'last_name' => ['required', 'min:3'],
            'email' => ['required', 'email'],
            'address' => ['required', 'min:8'],
            'phone_number' => ['required', 'regex:/^\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}$/'],
        ]);

        $formFields['cart'] = serialize($cart);

        $formFields['user_identifier'] = Auth::User() ? Auth::User()->email : 'guest';

        $formFields['additional_information'] = $request['additional_information'] ? $request['additional_information'] : '';

        Order::create($formFields);

        $cart = null;
        $request->session()->forget('cart');

        return redirect('/')->with('message', 'Your order has been created!');

    }
}
