<?php

use App\Http\Controllers\Admin\{
    Auth\AuthController,
    Home\AdminSettingController,
    Home\HomeController,
};
use Illuminate\Support\Facades\Route;

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
Route::get('/', [HomeController::class, 'adminRedirect']);
Route::get('/login', [AuthController::class, 'view'])->name('admin.login');
Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');

Route::group(['namespace' => 'Admin','prefix' => 'admin','middleware'=>'admin'],function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin.index');


    //========================= Logout ========================
    Route::get('logout',[AuthController::class,'logout'])->name('admin.logout');


    // ============================ setting ================
    Route::resource('settings','Home\AdminSettingController');

    //////////////////// require other links //////////////
    require __DIR__.'/adminRoutes/crud.php';
    require __DIR__.'/adminRoutes/orders.php';

});
