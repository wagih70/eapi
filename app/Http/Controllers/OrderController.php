<?php

namespace App\Http\Controllers;

use App\Notifications\ChangeStatus;
use App\Order;
use App\OrderItem;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    
    public function setOrder($total=0)
    {
        
        $cart = session()->get('cart');
        if($cart){

            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->number = rand(1000000,10000000);
            $order->status = 'Placed';
            $order->total = $total;
            $order->save();
            
            foreach ($cart as $key => $value) {
                
                $orderItem = new OrderItem;
                $orderItem->order_id = $order->id;
                $orderItem->name = $value['name'];
                $orderItem->price = $value['price'];
                $orderItem->quantity = $value['quantity'];
                $orderItem->photo = $value['photo'];
                $orderItem->save();

            }
            session()->forget('cart');
            
            return redirect()->back()->with('success', 'Order is Placed successfully!');

        }else{

            return redirect()->back()->with('success', 'Please add your products!');
        }
    }


    public function getOrders()
    {
        $orders = User::find(Auth::user()->id)->orders;
        return view('allOrders',compact('orders'));
    }

    public function showOrder($id)
    {
        $order = Order::find($id);
        if(Auth::user()->id == $order->user_id){
            return view('showOrder',compact('order'));
        }else{
            return redirect()->back();
        }
        
    }

    public function updateStatus($id,$status)
    {
        $order = Order::find($id);
        $order->status = $status;
        $order->update();

        $number = $order->number;
        $orderId = $id;
        Auth::user()->notify(new ChangeStatus($orderId,$number,$status));

    }
}
