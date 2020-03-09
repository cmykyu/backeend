<?php

namespace App\Http\Controllers;
use DB;


use App\News;
use App\Products;
use Illuminate\Http\Request;

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
        return view ('front/products');
    }

    // public function products_detail($id){
    //     $news = Products::find($id);
    //     return view ('front/news_detail', compact('news'));
    // }



}
