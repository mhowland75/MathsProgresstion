<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;
use App\Test;
use App\StudentsAnswer;

class QuestionsController extends Controller
{
    public function manage(Question $id){
      return view('tests.answers.manage',compact('id'));
    }

    public function manage_answers(){
      return view('test.questions.manageAnswers');
    }
    public function create(){
      return view('tests.questions.create');
    }
    public function store(request $request){
      $filename = $request->image->getClientOriginalName();
      $data = new Question;
      $data->test_id = $request->test_id;
      $data->question = $request->question;
      $data->value = $request->value;
      $data->visibility = 0;
      $data->image = $filename;
      $data->save();
      $request->image->storeAs('public/Questions', $filename);
      return redirect()->back();
    }
    public function visiblity($id){
      Question::change_visibility($id);
      return redirect()->back();
    }
    public function delete($id){
        StudentsAnswer::delete_by_questionid($id);
        Answer::where('question_id',$id)->delete();
        Question::destroy($id);
        return redirect()->back();
    }
}
