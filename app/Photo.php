<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
  public function galleries(){
    return $this->belongsTo('App\Gallery');
  }
}