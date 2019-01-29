<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Answer;
use App\Question;
use App\StudentLogin;
use App\StudentsResult;
use App\StudentsAnswer;
use App\StudentYear;
use App\Student;
use App\Subject;
use App\Test;

class testingController extends Controller
{
    public function test(){
      $subj = Subject::getSubjects();
      $array = array();
      foreach($subj as $sub){
        $s = Student::where('student_id',StudentLogin::get_student_id())->get();
        $results = StudentsResult::studentResults($s,$sub);
        $array[$sub->subject] = $results;
      }
    //  return $array;
      return view('tests.studentResults.results',compact('tests','nav','year_id','course','array'));
    }
}
