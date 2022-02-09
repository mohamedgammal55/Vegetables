<?php
use Illuminate\Support\Facades\Route;
Route::group(['namespace' => 'Orders'],function () {
    Route::resource('orders','OrderController');
});
