<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Posts;
use App\Model\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Validator;
use Uuid;

class AdminController extends Controller
{
    public function landing(){ //harus ditambah untuk dashboard
      return view('admin.welcome');
    }

    public function indexLogin(){
      if(Auth::user()){
        return redirect('/admin');
      }
      return view('admin.login');
    } //done

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
    } //done

    public function viewPost($id){
      $posts['posts'] = Posts::where('id_post',$id)->first();
      return view('admin.posts',$posts);
    } //done

    public function createPost(){
      return view('admin.create');
    } //done

    public function post(Request $request){
      $rules = [
        'title' => 'required',
        'isi' => 'required',
      ];
      $messages = [
        'title.required' => 'Title tidak boleh kosong',
        'isi.required' => 'Deskripsi tidak boleh kosong',
      ];
      $validator = Validator::make($request->all(),$rules,$messages);
      if($validator->fails()){
        return redirect('/admin/article/create')->withErrors($validator)->withInput();
      }
      $posts = new Posts();
      $posts->id_post = Uuid::generate();
      $posts->title = $request->title;
      $posts->description = $request->isi;
      $posts->save();
      return redirect('/admin/article/view/'.$posts->id_post);
    } //done

    public function edit($id){
      $posts['posts'] = Posts::where('id_post',$id)->first();
      return view('admin.edit',$posts);
    } //done

    public function editPost($id, Request $request){
      Posts::where('id_post',$id)->update([
        'title' => $request->title,
        'description' => $request->isi
      ]);
      return redirect('/admin/article/view/'.$id);
    } //done

    public function Agenda(){
      return view('admin.create_event');
    } //done

    public function createAgenda(Request $request){
      // dd($request->picture);
      $rules = [
        'picture' => 'mimes:jpeg,png,jpg,bmp,tiff | max:4096',
        'title' => 'required',
      ];
      $messages = [
        'title.required' => 'Masukan title',
        'picture.mimes' => 'File gambar bukan berformat jpeg,png,jpg,bmp,tiff',
        'picture.max' => 'File gambar melebihi batas 4mb',
      ];
      $validator = Validator::make($request->all(),$rules,$messages);
      if($validator->fails()){
        return redirect('/admin/agenda/create')->withErrors($validator);
      }
      $agenda = new Event();
      $agenda->id_event = Uuid::generate();
      $agenda->title = $request->title;
      if($request->file('picture') == NULL){
        $agenda->image = "img/default.png";
      }
      else{
        $picture = $request->file('picture');
        $agenda->image = Uuid::generate().'.'.$picture->getClientOriginalExtension();
        $picture->move('uploads',$agenda->image);
      }
      $agenda->save();
      return redirect('/');
    } //done

    public function editAgenda($id){
      $event['event'] = Event::where('id_event',$id)->first();
      return view('admin.edit_event',$event);
    } //done

    public function postEditAgenda($id, Request $request){
      $event = Event::where('id_event',$id)->first();
    }

    public function logout(){
      Auth::logout();
      return redirect('/')->with('success','Logout berhasil');
    } //done
}
