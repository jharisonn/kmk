<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
 protected $table = 'posts';
 protected $primaryKey = 'id_post';
 public $incrementing = true;
 public $timestamp = false;

 public function comment(){
   return $this->hasMany('App\Model\Comment','id_post','id_post');
 }
}
