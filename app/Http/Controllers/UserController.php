<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\User;

class UserController extends Controller
{
    public function loadUser(Request $request){
        if(Session::get('login') == false){
            return redirect('/login');
        }else if(Session::get('status') == '0'){
            return redirect('/public');
        }
        
        $data['users'] = User::all();

        if(!empty($request->cari)){
            $data['users'] = User::where('username','like','%'.$request->cari.'%')->get();
        }

        return View('user', $data);
    }
    public function loadAddUser(){
        if(Session::get('login') == false){
            return redirect('/login');
        }else if(Session::get('status') == '0'){
            return redirect('/public');
        }

        return View('adduser');
    }
    public function storeAddUser(Request $request){
        $this->validate($request, [
            'username'=>'required|unique:user,username',
            'password'=>'required|min:8',
            'password'=>'required'
        ]);
        
        $user = new User;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->status = $request->status;
        $user->save();
        
        return redirect('/user');
    }
    public function loadEditUser($id){
        if(Session::get('login') == false){
            return redirect('/login');
        }else if(Session::get('status') == '0'){
            return redirect('/public');
        }
        
        $data['user'] = User::where('id',$id)->first();
        
        return View('edituser',$data);
    }
    public function storeEditUser(Request $request, $id){
        $user = User::where('id',$id)->first();
        if($user->username == $request->username){
            $this->validate($request, [
                'password'=>'required|min:8',
                'password'=>'required'
            ]);
        }else{
            $this->validate($request, [
                'username'=>'required|unique:user,username',
                'password'=>'required|min:8',
                'password'=>'required'
            ]);

        }
        $user->username = $request->username;
        $user->password = $request->password;
        $user->status = $request->status;
        $user->save();
        
        return redirect('/user');
    }
    public function deleteEditUser($id){
        if(Session::get('login') == false){
            return redirect('/login');
        }else if(Session::get('status') == '0'){
            return redirect('/public');
        }

        $user = User::where('id',$id)->delete();

        return redirect('/user');
    }
}
