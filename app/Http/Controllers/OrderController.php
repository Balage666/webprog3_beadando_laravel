<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function View(Request $request, User $User) {

        $orders = $User->Orders()->paginate(5);

        // dd($orders[0]->id);
        foreach ($orders as $order) {
            $order->cart = unserialize($order->cart);
        }

        return view('orders.index', ['Orders' => $orders]);

    }

    public function Refund(User $User, Order $Order) {

        // dd($User->Orders()->find($Order->id));

        $User->Orders()->find($Order->id)->delete();

        return redirect('/')->with('message', 'You have refunded your order!');
    }

}
