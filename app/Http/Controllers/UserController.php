<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Posts;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function landing(){
      return view('user.welcome');
    }

    public function viewPost($id){
      $posts['posts'] = Posts::where('id_post',$id)->first();
      return view('user.posts',$posts);
    }
}
