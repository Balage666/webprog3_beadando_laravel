<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function View(Request $request, User $User) {

        if ($User->id != Auth::User()->id) {
            return abort(403);
        }

        $orders = $User->Orders()->paginate(5);

        // dd($orders[0]->id);
        foreach ($orders as $order) {
            $order->cart = unserialize($order->cart);
        }

        return view('orders.index', ['Orders' => $orders]);

    }

    public function Refund(User $User, Order $Order) {

        if ($User->id != Auth::User()->id) {
            return abort(403);
        }

        // dd($User->Orders()->find($Order->id));

        $User->Orders()->find($Order->id)->delete();

        return redirect('/')->with('message', 'You have refunded your order!');
    }
}
