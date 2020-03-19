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
use TsaiYiHua\ECPay\Checkout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    protected $checkout;

    public function __construct(Checkout $checkout)
    {
        $this->checkout = $checkout;
    }

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


    //購物車

    public function add_cart($productId){
        // $productId = $product_id;

        $Product = Products::find($productId); // assuming you have a Product model with id, name, description & price
        $rowId = $productId ;// generate a unique() row ID
        $userID = Auth::id(); // the user ID to bind the cart contentsdd
        // add the product to cart
        \Cart::session($userID)->add(array(
            'id' => $rowId,
            'name' => $Product->content,
            'price' => $Product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $Product
        ));

        return redirect('/cart');
    }

    public function update_cart(Request $request ,$product_id){
        $quantity = $request->quantity;

        Cart::update($product_id, array(
            'quantity' => $quantity, // so if the current product has a quantity of 4, it will subtract 1 and will result to 3
          ));

        return 'success';
    }

    public function delete_cart(Request $request ,$product_id){

        Cart::remove($product_id);
        return 'success';
    }

    public function cart_total()
    {
        $items = \Cart::getContent()->sort();

        return view('front.cart', compact('items'));
    }

    public function cart_checkout()
    {
        $items = \Cart::getContent()->sort();
        return view('front.cart_checkout', compact('items'));
    }




    public function post_cart_checkout(Request $request){

        $recipient_name = $request->recipient_name;
        $recipient_phone = $request->recipient_phone;
        $recipient_address = $request->recipient_address;
        $shipment_time = $request->shipment_time;
    }







    public function sendOrder()
    {
        $formData = [
            'UserId' => 1, // 用戶ID , Optional
            'ItemDescription' => '產品簡介',
            'ItemName' => 'Product Name',
            'TotalAmount' => '2000',
            'PaymentMethod' => 'Credit', // ALL, Credit, ATM, WebATM
        ];
        return $this->checkout->setPostData($formData)->send();
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
