<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Test;
use App\Question;
use App\Answer;
use App\StudentsAnswer;

class StudentsResult extends Model
{
    protected $table = 'students_results';

    public function student_answers(){
      return $this->hasMany('App\StudentsAnswer','results_id');
    }

    public function test(){
      return $this->belongsTo('App\Test','test_id');
    }

    public static function get_lastest_test_of_student($subject = 'maths'){
      $tests = Test::get_tests($subject);
      foreach($tests as $test){
        $test->results = static::where('student_id',StudentLogin::get_student_id())->where('test_id',$test->id)->latest()->first();
      }
      return $tests;
    }
    public static function get_student_results($test_id){
      return static::where('test_id',$test_id)->where('student_id',StudentLogin::get_student_id())->latest()->first();
    }
    public static function delete_test($id){

      $results_ids = StudentsResult::where('test_id',$id)->get();
      foreach($results_ids as $result_id){
        StudentsAnswer::where('results_id',$result_id->id)->delete();
      }
      StudentsResult::where('test_id',$id)->delete();

      Question::where('test_id',$id)->delete();
      Answer::where('test_id',$id)->delete();
    }

}
