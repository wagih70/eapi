<?php

namespace App\Http\Controllers;

use App\Notifications\ChangeStatus;
use App\Order;
use App\OrderItem;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $products = [];
        $client = new \GuzzleHttp\Client();

        $res = $client->get('https://mangomart-autocount.myboostorder.com/wp-json/wc/v1/products', ['auth' =>  ['ck_2682b35c4d9a8b6b6effac126ac552e0bfb315a0', 'cs_cab8c9a729dfb49c50ce801a9ea41b577c00ad71']]);

        $max_pages = $res->getHeaderLine('X-WP-TotalPages');

        for ($i=1; $i <= $max_pages ; $i++) { 

            $res = $client->get('https://mangomart-autocount.myboostorder.com/wp-json/wc/v1/products?page='.$i, ['auth' =>  ['ck_2682b35c4d9a8b6b6effac126ac552e0bfb315a0', 'cs_cab8c9a729dfb49c50ce801a9ea41b577c00ad71']]);
            
            $result = json_decode($res->getBody(),true);

            foreach ($result as $key => $value) {
                if($value['regular_price'] == ""){
                    $value['regular_price'] = 0;
                }
                array_push($products, [$value['name'],$value['images'][0]['src_small'],$value['regular_price'], $value['id']]);
            }
        }
        
        return view('allProducts',compact('products'));
    }

}