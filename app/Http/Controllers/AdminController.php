<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class AdminController extends Controller
{
    public function landing(){
      return view('admin.welcome');
    }
    public function indexLogin(){
      return view('admin.login');
    }

    public function login(Request $request){
      $rules = [
        'username' => 'required',
        'password' => 'required',
      ];
      $messages = [
        'username.required' => 'Username field is empty',
        'password.required' => 'Password field is empty',
      ];

      $validator = Validator::make($request->all(),$rules,$messages);

      if($validator->fails()){
        return redirect('/admin/login')->withErrors($validator)->withInput();
      }

      if(Auth::attempt(['username' => $request->input('username'),
       'password' => $request->input('password')],$request->remember)){
         return redirect('/admin');
       }
       return redirect('/admin/login')->with('error','Username / Password salah');
    }

    public function logout(){
      Auth::logout();
      return redirect('/')->with('success','Logout berhasil');
    }
}
