<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function admin;
use function response;
use function view;

class AuthController extends Controller
{
    public function view(){
        if (admin()->check())
            return \redirect('admin');
        return view('Admin.Auth.login');
    }//end fun

    public function login(Request $request){

        $data = $request->validate([
            'user_name'=>'required|exists:admins,user_name',
            'password'=>'required'
        ]);

        if (admin()->attempt($data)){
            return response(['code'=>200]);
        }


        return response()->json([
            'message' => 'كلمة المرور خاطئة',
            "code"=>402,
        ],300);


    }//end fun

}//end class
