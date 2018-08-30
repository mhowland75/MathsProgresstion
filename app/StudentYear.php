<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Student;

class StudentYear extends Model
{
  public function unit(){
    return $this->belongsTo('App\Unit');
  }
  public function students(){
    return $this->hasMany('App\Student');
  }
    public static function activateLogins($year){
      $studentYear = static::find($year);
      if($studentYear->student_login_active == 1){
        $value = 0;
      }
      else{
        $value = 1;
      }
      $studentYear->student_login_active = $value;
      $studentYear->save();
    }
    public static function StudentYearDelete($StudentYearId){
      Student::where('student_year_id',$StudentYearId)->delete();
      StudentLogin::where('student_year_id',$StudentYearId)->delete();
      static::destroy($StudentYearId);
    }
}
