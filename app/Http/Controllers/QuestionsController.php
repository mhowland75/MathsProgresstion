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
    /**
     * Question manage
     */
    public function manage(Question $id){
      return view('tests.answers.manage',compact('id'));
    }
    /**
     * Manage answers
     */
    public function manage_answers(){
      return view('test.questions.manageAnswers');
    }

    /**
     * Edit Questions
     */
    public function edit(Question $question){
      if(Unit::unitActive($question->test->unit->id)){
        return Redirect()->back()->withErrors(['You are trying to modify an active unit. Modification of units is disabled while they are active.', '']);
      }
        if(!empty($question->image)){
          $question->image = Storage::url($question->image);
        }else{
          $question->image = 0;
        }
      return view('tests.questions.edit',compact('question'));
    }

    /**
     * Update Questions
     */
    public function update(request $request){
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

    /**
     * Store Questions
     */
    public function store(request $request){
      $test = Test::find($request->test_id);
      if(Unit::unitActive($test->unit->id)){
        return Redirect()->back()->withErrors(['You are trying to modify an active unit. Modification of units is disabled while they are active.', '']);
      }
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
    /**
     * Delete Questions
     */
    public function delete(Question $question){
      if(Unit::unitActive($question->test->unit->id)){
        return Redirect()->back()->withErrors(['You are trying to modify an active unit. Modification of units is disabled while they are active.', '']);
      }
        Question::deleteQuestion($question->id);
        return redirect()->back();
    }
    /**
     * Question visibility
     */
    public function visibility(Question $question){
      if(Unit::unitActive($question->test->unit->id)){
        return Redirect()->back()->withErrors(['You are trying to modify an active unit. Modification of units is disabled while they are active.', '']);
      }
      Question::change_visibility($question->id);
      return redirect()->back();
    }
}
