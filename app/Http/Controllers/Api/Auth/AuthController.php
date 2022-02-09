<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\UploadFiles;
use App\Models\Customers;
use App\Models\PhoneToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tymon\JWTAuth\Exceptions\JWTException;
class AuthController extends Controller
{
    use UploadFiles;
    public function __construct()
    {
        $this->middleware(['apiAuth',"apiPermission:logout"])->only('logout'/*,'getProfile'*/);
    }//end fun
    public function login(Request $request){
        $rules = [
            'user_name'=>'required|exists:users,user_name',
            'password'=>'required',
            'lang'=>'required|in:ar,en'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return helperJson(null,$validator->errors());
        }

        $data = $request->except('lang');

        if (!auth()->attempt($data)){
            return helperJson(null,'your password in wrong',409);

        }

        if (! $token = JWTAuth::fromUser(auth()->user())) {
            return helperJson(null,'there is no user',400);
        }

        \auth()->user()->lang = $request->lang;
        \auth()->user()->save();
        return helperJson($this->respondWithToken($token,auth()->user()),'good login');


    }//end fun
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request){

        return $request->user();
//        $token = JWTAuth::fromUser(auth()->user());
//        JWTAuth::setToken($token)->invalidate();
//        \auth()->logout();
//            return helperJson(null,'log out successfully',200);

    }//end fun
    /**
     * @param $token
     * @param $user
     * @return array
     */
    protected function respondWithToken($token,$user)
    {
        return [
            'user'=>$user,
            'access_token' => 'Bearer '.$token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL()
        ];
    }//end fun
}//end class
