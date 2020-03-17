<?php

namespace App\Http\Controllers;
use DB;

// use Cart;
use App\News;
use App\ConTacts;
use App\Products;
use App\Mail\OrderShipped;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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



    public function products_detail(){

        $Product = Products::find(1);
        return view ('front/products_detail',compact('Product'));
    }

    // public function products_detail($product_id){
    //     $productId = $product_id;
    //     $product = Products::find($productId);
    //     // dd($Product);
    //     return view ('front/products_detail', compact('product'));
    // }

    public function add_cart($productId){
        // $productId = $product_id;

        $Product = Products::find($productId); // assuming you have a Product model with id, name, description & price
        $rowId = "444" ;// generate a unique() row ID
        $userID = Auth::id(); // the user ID to bind the cart contentsdd
        // add the product to cart
        \Cart::session($userID)->add(array(
            'id' => $rowId,
            'name' => $Product->content,
            'price' => $Product->price,
            'quantity' => 4,
            'attributes' => array(),
            'associatedModel' => $Product
        ));

        return redirect('/cart');
    }



    public function cart_total(){
        $userID = Auth::user()->id;
        $items = \Cart::session($userID)->getContent();
        // dd($items);
        return view ('front/cart', compact('items'));
    }

    public function cart(){
        return view ('front/cart');
    }


    public function contact(){
        return view ('front/contact');
    }

    public function contact_store(Request $request){


        $contacts_data = $request->all();

        $content=ConTacts::create($contacts_data);

        Mail::to($request->email)->send(new OrderShipped($content));

        return redirect('/contact');
    }











}
