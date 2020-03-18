<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FrontController@index');

Route::get('/news','FrontController@news');
Route::get('/news_detail/{id}','FrontController@news_detail');




Route::get('/contact','FrontController@contact');

Route::post('/contacts/store','FrontController@contact_store');

Route::get('/products','FrontController@products');//產品頁
Route::get('/products_detail','FrontController@products_detail');//產品內容介紹頁
Route::post('/add_cart/{product_id}','FrontController@add_cart'); //cart 加入購物車
Route::post('/update_cart/{product_id}','FrontController@update_cart'); //cart 更新購物車數量
Route::post('/delete_cart/{product_id}','FrontController@delete_cart'); //cart 刪除商品於購物車中
Route::get('/cart','FrontController@cart_total'); //cart 總覽

Route::get('/cart_checkout','FrontController@cart_checkout'); //cart 結帳
Route::post('/cart_checkout','FrontController@post_cart_checkout'); //cart 結帳

Route::get('/TEST','FrontController@sendOrder');//純測試用



Route::prefix('cart_ecpay')->group(function(){

    //當消費者付款完成後，綠界會將付款結果參數以幕後(Server POST)回傳到該網址。
    Route::post('notify', 'CartController@notifyUrl')->name('notify');

    //付款完成後，綠界會將付款結果參數以幕前(Client POST)回傳到該網址
    Route::post('return', 'CartController@returnUrl')->name('return');
});







Route::get('/checkout','FrontController@products_detail');

Auth::routes();


Route::group (['middleware' => ['auth'],'prefix' => '/home'],function(){

     //首頁
     Route::get('/', 'HomeController@index');

     //最新消息
     Route::get('news', 'NewsController@index');

     Route::get('news/create', 'NewsController@create');
     Route::post('news/store', 'NewsController@store');

     Route::get('news/edit/{id}', 'NewsController@edit');
     Route::post('news/update/{id}', 'NewsController@update');

     Route::post('news/delete/{id}', 'NewsController@delete');
     Route::post('ajax_delete_news_imgs', 'NewsController@ajax_delete_news_imgs');

     Route::post('ajax_upload_img', 'UploadImgController@ajax_upload_img');
     Route::post('ajax_delete_img', 'UploadImgController@ajax_delete_img');


     //產品管理
     Route::get('products', 'ProductsController@index');
     Route::get('products/create', 'ProductsController@create');
     Route::post('products/store', 'ProductsController@store');

     Route::get('products/edit/{id}', 'ProductsController@edit');
     Route::post('products/update/{id}', 'ProductsController@update');

     Route::post('products/delete/{id}', 'ProductsController@delete');

     //產品類別管理
     Route::get('productType', 'ProductTypeController@index');
     Route::get('productType/create', 'ProductTypeController@create');
     Route::post('productType/store', 'ProductTypeController@store');

     Route::get('productType/edit/{id}', 'ProductTypeController@edit');
     Route::post('productType/update/{id}', 'ProductTypeController@update');

     Route::post('productType/delete/{id}', 'ProductTypeController@delete');

     //聯絡我們管理
     Route::get('contacts', 'ContactController@index');
     Route::get('contacts/create', 'ContactController@create');
     Route::get('contacts/store', 'ContactController@store');

     Route::get('contacts/edit/{id}', 'ContactController@edit');
     Route::post('contacts/update/{id}', 'ContactController@update');

     Route::post('contacts/delete/{id}', 'ContactController@delete');


});







