<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Answer;
use App\Question;
use App\Test;
use App\Unit;
use App\StudentsAnswer;

class QuestionsController extends Controller
{
    public function manage(Question $id){
      return view('tests.answers.manage',compact('id'));
    }

    public function manage_answers(){
      return view('test.questions.manageAnswers');
    }
    public function edit(Question $question){
      if(Unit::unitActive($question->test->unit->id)){
        return Redirect()->back()->withErrors(['You are unable to create, edit or delete any test, questions or answers whilst the unit is being actively used for students testing. Allowing this would corrupt the integrity of the students results. ', '']);
      }
        if(!empty($question->image)){
          $question->image = Storage::url($question->image);
        }else{
          $question->image = 0;
        }
      return view('tests.questions.edit',compact('question'));
    }
    public function update(request $request){
      //return $request->all();
      $data = Question::find($request->question_id);
      if(empty($request->rem_image)){
        if(!empty($request->image)){
          $filename = $request->image->getClientOriginalName();
          $data->image = $filename;
          $request->image->storeAs('public/', $filename);
        }
      }else{
        $data->image = 0;
      }
      $data->test_id = $data->test->id;
      $data->question = $request->question;
      $data->visibility = 1;
      $data->save();
      return redirect()->back();
    }
    public function store(request $request){
      if(!empty($request->image)){
        $filename = $request->image->getClientOriginalName();
      }else{
        $filename = 0;
      }
      $data = new Question;
      $data->test_id = $request->test_id;
      $data->question = $request->question;
      $data->visibility = 1;
      $data->image = $filename;
      $data->save();
      if(!empty($filename)){
        $request->image->storeAs('public/', $filename);
      }
      return redirect()->back();
    }
    public function delete(Question $question){
      if(Unit::unitActive($question->test->unit->id)){
        return Redirect()->back()->withErrors(['You are unable to create, edit or delete any test, questions or answers whilst the unit is being actively used for students testing. Allowing this would corrupt the integrity of the students results. ', '']);
      }
        Question::deleteQuestion($question->id);
        return redirect()->back();
    }

    public function visibility(Question $question){
      if(Unit::unitActive($question->test->unit->id)){
        return Redirect()->back()->withErrors(['You are unable to create, edit or delete any test, questions or answers whilst the unit is being actively used for students testing. Allowing this would corrupt the integrity of the students results. ', '']);
      }
      Question::change_visibility($question->id);
      return redirect()->back();
    }
}
