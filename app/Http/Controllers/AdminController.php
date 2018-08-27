<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Posts;
use Illuminate\Support\Facades\Auth;
use Validator;

class AdminController extends Controller
{
    public function landing(){
      return view('admin.welcome');
    }
    public function indexLogin(){
      if(Auth::user()){
        return redirect('/admin');
      }
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

    public function viewPost($id){
      $posts['posts'] = Posts::where('id_post',$id)->first();
      return view('admin.posts',$posts);
    }

    public function createPost(){
      return view('admin.create');
    }

    public function post(Request $request){
      $posts = new Posts();
      $posts->title = $request->title;
      $posts->description = $request->isi;
      $posts->save();
      return redirect('/admin/article/view/'.$posts->id_post);
    }

    public function edit($id){
      $posts['posts'] = Posts::where('id_post',$id)->first();
      return view('admin.edit',$posts);
    }

    public function editPost($id, Request $request){
      Posts::where('id_post',$id)->update([
        'title' => $request->title,
        'description' => $request->isi
      ]);
      return redirect('/admin/article/view/'.$id);
    }

    public function logout(){
      Auth::logout();
      return redirect('/')->with('success','Logout berhasil');
    }
}
