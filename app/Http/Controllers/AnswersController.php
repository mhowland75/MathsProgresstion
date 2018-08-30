<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Unit;
use App\StudentsAnswer;

class AnswersController extends Controller
{
    public function create(){
      return view('tests.answers.create');
    }
    public function edit(Answer $answer){
      if(Unit::unitActive($answer->question->test->unit->id)){
        return Redirect()->back()->withErrors(['You are unable to create, edit or delete any test, questions or answers whilst the unit is being actively used for students testing. Allowing this would corrupt the integrity of the students results. ', '']);
      }
      return view('tests.answers.edit',compact('answer'));
    }
    public function update(request $request){
      $data = Answer::find($request->answer_id);
      Answer::check_and_change_correct_answer($data->test_id,$data->question_id);
      $data->answers = $request->answers;
      $data->right_answer = $request->right_answers;
      $data->save();
      return redirect('/questions/'.$data->question->id.'/answers');
    }
    public function store(request $request){
      //return $request;
      Answer::check_and_change_correct_answer($request->test_id,$request->question_id);
      $data = new Answer;
      $data->test_id = $request->test_id;
      $data->question_id = $request->question_id;
      $data->answers = $request->answers;
      $data->right_answer = $request->right_answers;
      $data->visibility = 1;
      $data->save();
      return redirect()->back();
    }
    public function correct_answer(Answer $answer){
      if(Unit::unitActive($answer->question->test->unit->id)){
        return Redirect()->back()->withErrors(['You are unable to create, edit or delete any test, questions or answers whilst the unit is being actively used for students testing. Allowing this would corrupt the integrity of the students results. ', '']);
      }
      Answer::check_and_change_correct_answer($answer->question->test->id, $answer->question->id, $answer->id);
      return redirect()->back();
    }
    public function delete(Answer $answer){
      if(Unit::unitActive($answer->question->test->unit->id)){
        return Redirect()->back()->withErrors(['You are unable to create, edit or delete any test, questions or answers whilst the unit is being actively used for students testing. Allowing this would corrupt the integrity of the students results. ', '']);
      }
      StudentsAnswer::delete_by_answerid($answer->id);
      Answer::delete_answer($answer->id);
      return redirect()->back();
    }
    public function visiblity(Answer $answer){
      if(Unit::unitActive($answer->question->test->unit->id)){
        return Redirect()->back()->withErrors(['You are unable to create, edit or delete any test, questions or answers whilst the unit is being actively used for students testing. Allowing this would corrupt the integrity of the students results. ', '']);
      }
      Answer::change_visibility($answer->id);
      return redirect()->back();
    }
}
