<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StudentYear;

class Unit extends Model
{
  public function studentsYears(){
    return $this->hasMany('App\StudentYear');
  }
    public function tests(){
      return $this->hasMany('App\Test');
    }
    public static function get_all_units(){
      return static::all();
    }
    public static function getStudentUnitId($student_id){

    }
    public static function unitActive($unit_id){
      $unit = StudentYear::where('unit_id', $unit_id)->where('student_login_active',1)->get();
      if(!empty($unit[0]->id)){
        return TRUE;
      }
      else{
        return FALSE;
      }
    }
    public static function unitDelete($unit_id){
      $tests = Test::where('unit_id',$unit_id)->get();
      foreach($tests as $test){
        Test::deleteTest($test->id);
      }
      static::destroy($unit_id);
    }
}
