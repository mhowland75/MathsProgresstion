<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\studentsResult;

class Test extends Model
{
  public function unit(){
    return $this->belongsTo('App\Unit');
  }
  public function subject(){
    return $this->belongsTo('App\Subject');
  }
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

  public static function getStudentTests($subject_id = NULL){
    $x = StudentLogin::where('student_id',StudentLogin::get_student_id())->get();
    $y = StudentYear::find($x[0]->student_year_id);
    //return $y->unit->tests;
    if(!empty($subject_id->id)){
      $tests = $y->unit->tests->where('visibility',1)->where('subject_id', $subject_id->id);
      return $tests;
    }else{
      $tests = $y->unit->tests->where('visibility',1);
      return $tests;
    }

  }

  public static function getStudentsTestsResults($tests){
    $results = array();
    foreach($tests as $test){
      $result = studentsResult::where('student_id',StudentLogin::get_student_id())->where('test_id',$test->id)->get();
      if(!empty($result[0])){
        $results[$test->id] = $result[0];
      }else{
        $results[$test->id] = $result;
      }
    }
    return $results;
  }
  public static function studentTestVerification($test_id){
    $tests = static::getStudentTests();
    if(!empty($tests)){
      foreach($tests as $test){
        if($test->id == $test_id){
          return TRUE;
        }
      }
    }
    return FALSE;
  }

  public static function deleteTest($testId){
    $questions = Question::where('test_id',$testId)->get();
    foreach($questions as $question){
      Question::deleteQuestion($question->id);
    }
    static::destroy($testId);
  }
  public static function studentTestResultsSummery($results){
    $passed = 0;
    $attempted = 0;
    $notAttempted = 0;
    foreach ($results as $result) {
      if(empty($result->id)){
        $notAttempted++;
      }elseif($result->test->passmark > $result->correct_answers){
        $attempted++;
      }elseif($result->test->passmark <= $result->correct_answers){
        $passed++;
      }
    }
    return array(
      'passed' => $passed,
      'attempted' => $attempted,
      'notAttempted' => $notAttempted,
    );
  }
}
