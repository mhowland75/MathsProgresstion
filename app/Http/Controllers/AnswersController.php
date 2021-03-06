<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;
use App\Unit;
use App\StudentsAnswer;

class AnswersController extends Controller
{
    /**
     * Answers Create
     */
    public function create(){
      return view('tests.answers.create');
    }

    /**
     * Answers Edit
     */
    public function edit(Answer $answer){
      if(Unit::unitActive($answer->question->test->unit->id)){
        return Redirect()->back()->withErrors(['You are unable to create, edit or delete any test, questions or answers whilst the unit is being actively used for students testing. Allowing this would corrupt the integrity of the students results. ', '']);
      }
      return view('tests.answers.edit',compact('answer'));
    }

    /**
     * Answers Update
     */
    public function update(request $request){
      $data = Answer::find($request->answer_id);
      Answer::check_and_change_correct_answer($data->test_id,$data->question_id);
      $data->answers = $request->answers;
      $data->right_answer = $request->right_answers;
      $data->save();
      return redirect('/questions/'.$data->question->id.'/answers');
    }

    /**
     * Answer Store
     */
    public function store(request $request){
      $question = Question::find($request->question_id);
      if(Unit::unitActive($question->test->unit->id)){
        return Redirect()->back()->withErrors(['You are trying to modify an active unit. Modification of units is disabled while they are active.', '']);
      }
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

    /**
     * Answer Correct
     */
    public function correct_answer(Answer $answer){
      if(Unit::unitActive($answer->question->test->unit->id)){
        return Redirect()->back()->withErrors(['You are trying to modify an active unit. Modification of units is disabled while they are active.', '']);
      }
      Answer::check_and_change_correct_answer($answer->question->test->id, $answer->question->id, $answer->id);
      return redirect()->back();
    }

    /**
     * Answer delete
     */
    public function delete(Answer $answer){
      if(Unit::unitActive($answer->question->test->unit->id)){
        return Redirect()->back()->withErrors(['You are trying to modify an active unit. Modification of units is disabled while they are active.', '']);
      }
      StudentsAnswer::delete_by_answerid($answer->id);
      Answer::delete_answer($answer->id);
      return redirect()->back();
    }

    /**
     * Answer visablity
     */
    public function visiblity(Answer $answer){
      if(Unit::unitActive($answer->question->test->unit->id)){
        return Redirect()->back()->withErrors(['You are unable to create, edit or delete any test, questions or answers whilst the unit is being actively used for students testing. Allowing this would corrupt the integrity of the students results. ', '']);
      }
      Answer::change_visibility($answer->id);
      return redirect()->back();
    }
}
