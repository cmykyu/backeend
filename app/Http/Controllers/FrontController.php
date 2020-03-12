<?php

namespace App\Http\Controllers;
use DB;


use App\News;
use App\Products;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index(){
    return view ('front/index');
    }

    public function news(){
        $news_data=DB::table('news')->orderBy('sort', 'desc')->get();
        return view ('front/news', compact('news_data'));
    }

    public function news_detail($id){
        $news = News::find($id);
        return view ('front/news_detail', compact('news'));
    }

    public function products(){
        $products_data=DB::table('products')->orderBy('sort', 'desc')->get();
        return view ('front/products', compact('products_data'));
    }



    public function products_detail($product_id){
        $Product = Products::find($productId);
        return view ('front/products_detail', compact('products'));
    }

    public function add_cart($product_id){
        $productId = $product_id;
        $Product = Products::find($productId); // assuming you have a Product model with id, name, description & price
        $rowId = $productId; // generate a unique() row ID
        $userID = Auth::user()->id; // the user ID to bind the cart contents

        // add the product to cart
        \Cart::session($userID)->add(array(
        'id' => $rowId,
        'name' => $Product->title,
        'price' => $Product->price,
        'quantity' => 1,
        'attributes' => array(),
        'associatedModel' => $Product
        ));

        return view ('front/add_cart');
    }

    public function cart_total(){
        $userID = Auth::user()->id;
        $items = \Cart::session($userID)->getContent();

        return view ('front/cart', compact('items'));
    }

    public function contact(){
        return view ('front/contact');
    }









}
