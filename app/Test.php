<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{

  public function questions(){
    return $this->hasMany('App\Question');
  }
  public function studentsResults(){
    return $this->hasMany('App\StudentsResult','test_id');
  }

  public static function get_tests_by_unit_id($id){
    return static::where('unit_id',$id)->get();
  }
  public function scopeIndexProducts($query,$primary_category,$secondary_category){
    return $query->where('primary_category',$primary_category)->where('secondary_category',$secondary_category);
  }

  public static function count_tests(){
    return static::all()->count();
  }

  public static function get_tests($subject){
    return static::where('department',$subject)->get();
  }

  public static function scopereturn_test_by_department($query,$department){
    return $query->where('department',$department);
  }
  public static function change_visibility($test_id){
    $visibility = static::select('visibility')->where('id',$test_id)->get();
    if($visibility[0]->visibility == 1){
      static::where('id',$test_id)->update(['visibility' => 0]);
    }
    else{
      static::where('id',$test_id)->update(['visibility' => 1]);
    }
  }
}
