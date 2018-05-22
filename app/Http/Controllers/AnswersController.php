<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\StudentsAnswer;

class AnswersController extends Controller
{
    public function create(){
      return view('tests.answers.create');
    }
    public function store(request $request){
      //return $request;
      Answer::check_and_change_correct_answer($request->test_id,$request->question_id);
      $data = new Answer;
      $data->test_id = $request->test_id;
      $data->question_id = $request->question_id;
      $data->answers = $request->answers;
      $data->right_answer = $request->right_answers;
      $data->visibility = 0;
      $data->save();
      return redirect()->back();
    }
    public function correct_answer(Answer $id){
      Answer::check_and_change_correct_answer($id->question->test->id, $id->question->id, $id->id);
      return redirect()->back();
    }
    public function delete($id){
      StudentsAnswer::delete_by_answerid($id);
      Answer::delete_answer($id);
      return redirect()->back();
    }
    public function visiblity($id){
      Answer::change_visibility($id);
      return redirect()->back();
    }
}
