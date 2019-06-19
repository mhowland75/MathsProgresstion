<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Test;
use App\Question;
use App\Answer;
use App\StudentsAnswer;
use App\Student;
use App\StudentYear;
use App\Unit;

class StudentsResult extends Model
{
    protected $table = 'students_results';

    public function student_answers(){
      return $this->hasMany('App\StudentsAnswer','results_id');
    }

    public function test(){
      return $this->belongsTo('App\Test','test_id');
    }
    public function student(){
      return $this->belongsTo('App\Student','student_id','student_id');
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
    public static function getTotalTests($year){
      $totalStudents = static::getStudents($year)->count();
      $year = StudentYear::find($year);
      $totalTests = Unit::find($year->unit_id)->tests->count();
      return $totalStudents * $totalTests;
    }
    public static function getStudents($year){
        return student::where('student_year_id',$year)->get();
    }
    public static function getTotalPassedTest($year){
      $students = static::getStudents($year);
      $x = 0;
      foreach($students as $student){
        //return $student->student_id;
        $results = static::where('student_id',$student->student_id)->get();
        if(!empty($results[0])){
          foreach($results as $result){
            if($result->correct_answers >= $result->test->passmark){
              $x++;
            }
          }
        }
      }
      return $x;
    }
    public static function getTotalPassedUnits($year,$subject){
      $results = array();
      $students = static::getStudents($year);
      $tests = Test::getStudentTests($subject);
      return $tests;

    }
    public static function studentTestResultsSummery($results, $students, $subject){
      $year = studentYear::where('id', $students[0]->student_year_id)->get();
      $unit = $year[0]->unit()->get();
      $totalTests = $unit[0]->tests()->where('subject_id',$subject->id)->count() * $students->count();
      $passed = 0;
      $attempted = 0;
      $notAttempted = 0;
      foreach ($results as $result) {
        if($result->test->passmark > $result->correct_answers){
          $attempted++;
        }elseif($result->test->passmark <= $result->correct_answers){
          $passed++;
        }
      }
      $x = $passed + $attempted;
      $notAttempted = $totalTests - $x;
      return array(
        'passed' => $passed,
        '%passed' => StudentsResult::calPercentage($passed,$totalTests),
        'attempted' => $attempted,
        '%attempted' => StudentsResult::calPercentage($attempted,$totalTests),
        'notAttempted' => $notAttempted,
        '%notAttempted' => StudentsResult::calPercentage($notAttempted,$totalTests),
        'totalTest' => $totalTests,
      );
    }
    public static function studentsTestResults($students, $subject){
      $array = array();
      $results = array();
      foreach($students as $student){
        foreach($student->studentResult as $result){
          if($result->test->subject_id == $subject->id){
            $results[] = $result;
          }
        }
      }
      return  $array[$subject->subject] = StudentsResult::studentTestResultsSummery($results, $students, $subject);

    }
    public static function studentoverallTestsResults($students, $subject){
      $testsPassed = 0;
      $testsAttempted = 0;
      $testsNotAttempted = 0;
      $totalTests = $students[0]->studentLogin->studentYear->unit->tests->where('subject_id',$subject->id)->count();
      foreach($students as $student){
         $array = array();
         $results = $student->studentResult;
         foreach($results as $result){
           if($result->test->subject_id == $subject->id){
             $array[$subject->subject][] = $result;
           }
         }
         $testpassed = 0;
         if(!empty($array[$subject->subject])){
           if(count($array[$subject->subject]) == $totalTests){
             foreach($array[$subject->subject] as $mathsResults){
               if($mathsResults->correct_answers >= $mathsResults->test->passmark){
                 $testpassed++;
               }
             }
             if($testpassed >= $totalTests){
               $testsPassed++;
             }
             elseif($testpassed <= $totalTests){
               $testsAttempted++;
             }
           }
           elseif(!empty($array[$subject->subject]) && count($array[$subject->subject]) <= $totalTests){
             $testsAttempted++;
           }
         }
         else{
           $testsNotAttempted++;
         }
      }
      return array(
        'testsPassed' => $testsPassed,
        '%testsPassed' => StudentsResult::calPercentage($testsPassed,$students->count()),
        'testsAttempted' => $testsAttempted,
        '%testsAttempted' => StudentsResult::calPercentage($testsAttempted,$students->count()),
        'testsNotAttempted' =>$testsNotAttempted,
        '%testsNotAttempted' => StudentsResult::calPercentage($testsNotAttempted,$students->count()),
        'totalStudents' => $students->count(),
    ); ;
    }
    public static function calPercentage($number1,$number2){
      if(!$number1 OR !$number2){
        return 0;
      }
      $x = $number1 / $number2 * 100;
      return  round($x,2);
    }
    public static function studentResults($students,$subject){
      foreach($students as $student){
        $unit_id = $student->studentLogin->studentYear->unit->id;
        $tests = Test::where('subject_id',$subject->id)->where('unit_id',$unit_id)->get();
        $testResults = array();
        $student->tests = $tests;
        $passed = 0;
        $attempted = 0;
        $notAttempted = 0;
        $testScores = array();

        foreach($student->tests as $test){
          $c = StudentsResult::where('student_id',$student->student_id)->where('test_id',$test->id)->get();
          if(!empty($c[0])){
            $test->result = $c[0];
          }else{
            $test->result = $c;
          }
          if(!empty($test->result->id)){
            if($test->result->correct_answers >= $test->passmark){
              $passed++;
            }else{
              $attempted++;
            }
          }
          else{
            $notAttempted++;
          }
        }
        $testScores['passed'] = $passed;
        $testScores['attempted'] = $attempted;
        $testScores['notAttempted'] = $notAttempted;
        if($passed == $student->tests->count()){
          $testScores['overAll'] = 'Pass';
        }elseif($passed > 0 || $attempted > 0){
          $testScores['overAll'] = 'Started';
        }elseif($notAttempted == $student->tests->count()){
          $testScores['overAll'] = 'Not Started';
        }
        $student->overallResult = $testScores;
      }
      return array('students' =>$students, 'tests'=>$tests);
    }
    public static function deleteStudentResultsByYear($year){
     $students = Student::where('student_year_id',$year)->get();
      foreach($students as $student){
        $results = StudentsResult::where('student_id',$student->student_id)->get();
        foreach($results as $result){
          StudentsAnswer::where('results_id',$result->id)->delete();
        }
        StudentsResult::where('student_id',$student->student_id)->delete();
    }
  }
  /**
   * Get studnets answered questions.
   */
  public function studentsAnsweredQuestions($test, $student_id)
  {
    return $this->where('test_id', $test->id)->get();
  }
}
