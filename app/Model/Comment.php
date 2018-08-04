<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
 protected $table = 'comment';
 protected $primaryKey = 'id_comment';
 public $incrementing = true;
 public $timestamp = false;

 public function post(){
   return $this->belongsTo('App\Model\Posts','id_post','id_post');
 }
}
