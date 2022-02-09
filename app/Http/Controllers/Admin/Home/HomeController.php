<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use function redirect;
use function view;

class HomeController extends Controller
{


    public function adminRedirect(){
        return redirect('admin');
    }//end fun


    public function index(){
        return view('Admin.index');
    }

}//end class
