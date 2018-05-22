<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;
use App\StudentLogin;
use App\StudentsResult;
use App\StudentsAnswer;

class StudentsResultsController extends Controller
{
  public function store(request $request){

    $question_id = array_keys($request->all());
    $question_id = $question_id[1];
    $test = Question::find($question_id)->test()->get();
    $result = new StudentsResult;
    $result->student_id = StudentLogin::get_student_id();
    $result->test_id = $test[0]->id;
    $result->correct_answers = Answer::get_test_results($request->all());;
    $result->total_questions = Question::count_question_in_test($test[0]->id);
    $result->attempt = 1;
    $result->save();

    foreach( $request->all() as $question_id => $answer_id){
      if($question_id == '_token'){
        continue;
      }
      $answer = new StudentsAnswer;
      $answer->results_id = $result->id;
      $answer->question_id = $question_id;
      $answer->answer_id = $answer_id;
      $answer->correct = Answer::get_is_answer_correct($question_id,$answer_id);
      $answer->save();
    }
    return redirect('/studentsResults/view/'.$result->test_id);
  }

  public function view($id){
     $studentResults = StudentsResult::get_student_results($id);
     //return $studentResults->student_answers;
    return view('tests.studentResults.view',compact('studentResults'));
  }
  public function index($subject){
    $tests = StudentsResult::get_lastest_test_of_student($subject);
    //return $tests;
    return view('tests.studentResults.index',compact('tests'));
  }

}
