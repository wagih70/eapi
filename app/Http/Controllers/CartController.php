<?php

namespace App\Http\Controllers;

use App\Notifications\ChangeStatus;
use App\Order;
use App\OrderItem;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
	
    public function cart()
    {
        return view('cart');
    }


    public function addToCart($id)
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->get('https://mangomart-autocount.myboostorder.com/wp-json/wc/v1/products/'.$id, ['auth' =>  ['ck_2682b35c4d9a8b6b6effac126ac552e0bfb315a0', 'cs_cab8c9a729dfb49c50ce801a9ea41b577c00ad71']]);

        $product = json_decode($res->getBody(),true);
        
        if(!$product) {
 
            abort(404);
 
        }
        
        if($product['regular_price'] == ""){

            $product['regular_price'] = 0;
        }

        $cart = session()->get('cart');
 
        // if cart is empty then this the first product
        if(!$cart) {

            $cart = [
                    $id => [
                        "name" => $product['name'],
                        "quantity" => 1,
                        "price" => $product['regular_price'],
                        "photo" => $product['images'][0]['src_small']
                    ]
            ];
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
 
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {
 
            $cart[$id]['quantity']++;
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'Product added to cart successfully!');
 
        }
 
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product['name'],
            "quantity" => 1,
            "price" => $product['regular_price'],
            "photo" => $product['images'][0]['src_small']
            ];
 
        session()->put('cart', $cart);
 
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
 
            $cart[$request->id]["quantity"] = $request->quantity;
 
            session()->put('cart', $cart);
 
            session()->flash('success', 'Cart updated successfully');
        }
    }   
 
    public function remove(Request $request)
    {
        if($request->id) {
 
            $cart = session()->get('cart');
 
            if(isset($cart[$request->id])) {
 
                unset($cart[$request->id]);
 
                session()->put('cart', $cart);
            }
 
            session()->flash('success', 'Product removed successfully');
        }
    }
}
