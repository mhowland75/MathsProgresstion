<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public function tests(){
      return $this->hasMany('App\Test');
    }
    public static function get_all_units(){
      return static::all();
    }
}
