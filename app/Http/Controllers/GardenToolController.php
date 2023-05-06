<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\GardenTool;
use Illuminate\Http\Request;
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
            'image' => ['mimes:png,jpg']
        ]);

        // dd($request);

        if ($request['description']) {
            $formFields['description'] = $request['description'];
        }
        else {
            $formFields['description'] = "Sample Description";
        }

        // dd($request->file('image'));

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('/uploads', 'public');
            $formFields['image'] = '/storage/'.$formFields['image'];
        }

        else {
            $formFields['image'] = "/assets/media/gardentools/def_market_gardener.png";
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
            'image' => ['mimes:png,jpg']
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
        }
        else {

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

        return redirect('/admin')->with('message','Tool has been deleted!');

    }

    public function AddToCart(Request $request, GardenTool $GardenTool)
    {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->Add($GardenTool, $GardenTool->id);

        $request->session()->put('cart', $cart);
        // dd($request->session()->get('cart'));

        return redirect('/');
    }
}
