<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\User;

class LoginController extends Controller
{
    public function loadIndex(){
        if(Session::get('login') == true){
            return redirect('/app');
        }else{
            return redirect('/login');
        }
    }
    public function loadLogin(){
        return View('login');
    }
    public function login(Request $request){
        $user = User::where('username',$request->username)->where('password',$request->password)->first();
        if(!empty($user)){
            Session::put('username',$user->username);
            Session::put('status',$user->status);
            Session::put('login', true);

            return redirect('/');
        }
        return redirect('/login');
    }
    public function logout(){
        Session::forget('login');
        Session::forget('status');
        Session::forget('username');

        return redirect('/');
    }
}
