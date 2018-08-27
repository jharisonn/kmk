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

Route::get('/', 'UserController@landing'); //done
Route::get('/article/view/{id}','UserController@viewPost'); //done

Route::prefix('admin')->group(function(){
  Route::get('/','AdminController@landing'); //done
  Route::get('/login','AdminController@indexLogin'); //done
  Route::post('/login','AdminController@login')->name('admin_login'); //done
  Route::middleware('adminonly')->group(function(){
    Route::get('/article/create','AdminController@createPost');//done
    Route::get('/article/view/{id}','AdminController@viewPost'); //done
    Route::post('/article/create','AdminController@post')->name('create_post'); //done
    Route::get('/article/edit/{id}','AdminController@edit'); //done
    Route::post('/article/edit/{id}','AdminController@editPost'); //done
    Route::get('/agenda/create','AdminController@createAgenda');
    Route::get('/logout','AdminController@logout')->name('logout'); //done
  });
});
