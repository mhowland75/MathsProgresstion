<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;

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
      return $array;
      //return view('tests.studentResults.results',compact('tests','nav','year_id','course','array'));
    }
}
