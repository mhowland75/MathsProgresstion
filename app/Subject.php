<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Test;

class Subject extends Model
{
  public function lessons(){
    return $this->hasMany('App\Education','subject_id');
  }
    public static function getSubjects(){
      return Subject::all();
    }
    public static function testSubjects(){
      $array = array();
      $x = Test::all();
      foreach($x as $y){
        if(!in_array($y->department, $array)){
          $array[] = $y->department;
        }
      }
      return $array;
    }

    public static function lessonSubjects(){
      $array = array();
      $x = Education::all();
      foreach($x as $y){
        if(!in_array($y->subject, $array)){
          $array[] = $y->subject;
        }
      }
      return $array;
    }
}
