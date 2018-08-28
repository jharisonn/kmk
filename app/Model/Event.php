<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  protected $table = 'event';
  protected $primaryKey = 'id_article';
  public $incrementing = false;
  public $timestamps = true;
}
