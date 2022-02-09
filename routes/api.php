<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



//================================== auth ============================
Route::group(['namespace' => 'Auth','prefix' => 'auth'],function (){
    Route::post('login','AuthController@login');
    Route::post('logout','AuthController@logout');
});

//================================== Home ============================
Route::group(['namespace' => 'Home','prefix' => 'home','middleware'=>'apiAuth'],function (){

    //////////////////////// products //////////////////////
    Route::get('products','HomeController@products');
    Route::post('addProduct','HomeController@addProduct');


    /////////////////////// customers //////////////////////////
    Route::get('customers','HomeController@customers');
    Route::post('addCustomer','HomeController@addCustomer');



    /////////////////////// categories //////////////////////////
    Route::get('categories','HomeController@categories');

});


//================================== order ============================
Route::group(['namespace' => 'Order','prefix' => 'order','middleware'=>'apiAuth'],function (){

    //////////////////////// Order //////////////////////
    Route::get('orders','OrdersController@orders');
    Route::post('storeOrder','OrdersController@storeOrder');
    Route::post('backOrder','OrdersController@backOrder');

});




Route::fallback(function () {
    return helperJson(null,'URL NOT FOUND!',404);
});
