<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'UserController@landing');
Route::get('/posts/{id}','UserController@viewPost');

Route::prefix('admin')->group(function(){
  Route::get('/','AdminController@landing');
  Route::get('/login','AdminController@indexLogin');
  Route::post('/login','AdminController@login')->name('admin_login');
  Route::get('/posts/{id}','AdminController@viewPost');
  Route::post('/posts/{id}','AdminController@post');
  Route::get('/logout','AdminController@logout')->name('logout');
});
