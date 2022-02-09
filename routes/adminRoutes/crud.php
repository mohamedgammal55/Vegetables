<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CRUD\{
  ProductController,
};

Route::group(['namespace' => 'CRUD','prefix'=>'CRUD'], function()
{

//============================ categories ========================
Route::resource('categories','CategoryController');


//============================ products ========================
Route::resource('products','ProductController');


//============================ admins ========================
Route::resource('admins','AdminsController');


//============================ employees ========================
Route::resource('employees','AdminEmployeesController');
Route::POST('employees-update-permission/{id}','AdminEmployeesController@employeeUpdatePermission')
    ->name('employees.update-permission');

});
