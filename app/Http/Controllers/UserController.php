<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Posts;
use App\Model\Event;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function landing(){
      $data['events'] = Event::orderBy('created_at','desc')->take(6)->get();
      $data['posts'] = Posts::orderBy('created_at','desc')->take(4)->get();
      return view('user.welcome',$data);
    }

    public function viewPost($id){
      $posts['posts'] = Posts::where('id_post',$id)->first();
      return view('user.posts',$posts);
    }
}
