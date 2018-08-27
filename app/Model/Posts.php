<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
 protected $table = 'posts';
 protected $primaryKey = 'id_post';
 public $incrementing = true;
 public $timestamps = true;

}
