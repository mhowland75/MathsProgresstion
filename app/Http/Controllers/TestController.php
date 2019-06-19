<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\Answer;
use Illuminate\Support\Facades\Storage;
use App\StudentsResult;
use App\StudentsAnswers;
use App\Unit;
use App\StudentYear;
use App\Student;
use App\Subject;
use App\StudentLogin;
class TestController extends Controller
{
    /**
     * Edit test
     */
    public function edit(Test $test){
      if(Unit::unitActive($test->unit->id)){
        return Redirect()->back()->withErrors(['You are trying to modify an active unit. Modification of units is disabled while they are active.', '']);
      }
      $subjects = Subject::getSubjects();
      //return $subjects;
      return view('tests.edit', compact('test','subjects'));
    }

    /**
     * Update test
     */
    public function update(request $request, $id){
      $test = test::find($id);
      $test->name = $request->name;
      $test->subject_id = $request->subject_id;
      $test->department = 0;
      $test->passmark = $request->passmark;
      $test->save();

      return redirect('/test/'.$test->unit->id.'/manage');
    }

    /**
     * Test view
     */
    public function view(Test $test){
      if(Test::studentTestVerification($test->id)){
        // Select all questions that student has not answered yet
        $student_result = StudentsResult::where('test_id', $test->id)->where('student_id', StudentLogin::get_student_id())->get();
        // Find test questions
        // Find unanswered questions.
        if(isset($student_result[0]->id)){
          $answered_question_ids = [];
          foreach($student_result[0]->student_answers as $answer){
            $answered_question_ids[] = $answer->question_id;
          }
          foreach($test->questions as $question){
            if(!in_array($question->id, $answered_question_ids)){
              $question = $test->questions->find($question);
              break;
            } else {
              $question = NULL;
            }
          }
        } else {
          $question = $test->questions->first();
        }
        if(!isset($question)){
          return redirect()->back();
        }else{
          if(!empty($question->image)){
            $question->image = Storage::url($question->image);
          }else{
            $question->image = 0;
          }
        }

        return view('tests.view2', compact('test', 'question'));
      }else {

        return redirect()->back();
      }

    }

    /**
     * loads tests of subject_id
     */
    public function index(Subject $subject_id){
      dump($subject_id);
      // If no student is logged in then redirect
      if(!StudentLogin::get_student_id())
      {
        return redirect('/student/login');
      }
      $tests = Test::getStudentTests($subject_id);
      dump(Test::getStudentsTestsResults($tests));
     // $results = Test::getStudentsTestsResults($tests);
      dump(2);
      $overallResults = Test::studentTestResultsSummery($results);
      dump(3);
      $subject = ucfirst($subject_id->subject);
      dump(4);
      
      return view('tests.index', compact('tests','results','subject', 'overallResults'));
    }

    /**
     * Manage Tests
     */
    public function manage(Unit $unit_id){
      $subjects = Subject::getSubjects();
    //  return $subjects;
      $array = array();
      foreach($subjects as $subject){
        $array[$subject->subject] = $unit_id->tests->where('subject_id',$subject->id);
      }
      return view('tests.manage',compact('array','subjects','unit_id'));
    }

    /**
     * Create Test
     */
    public function create(){
      return view('tests.create');
    }

    /**
     * Create Store
     */
    public function store(request $request){
      if(Unit::unitActive($request->unit_id)){
        return Redirect()->back()->withErrors(['You are unable to create, edit or delete any test, questions or answers whilst the unit is being actively used for students testing. Allowing this would corrupt the integrity of the students results. ', '']);
      }
      //return $request->unit_id;
      $request->validate([
        'name' => 'required|max:30',
        'passmark' => 'required|integer',
      ]);
      //$filename = $request->image->getClientOriginalName();
      $data = new Test;
      $data->name = $request->name;
      $data->unit_id = $request->unit_id;
      $data->department = 0;
      $data->subject_id = $request->subject_id;
      $data->passmark = $request->passmark;
      $data->visibility = 1;
      //$data->created_by = Auth::id();
      $data->save();
      //$request->image->storeAs('public', $filename);
      return redirect()->back();
    }

    /**
     * Manage Questions
     */
    public function manageQuestions(Test $id){
      foreach($id->questions as $x){
        if(!empty($x->image)){
          $x->image = Storage::url($x->image);
        }else{
          $x->image = 0;
        }
      }
      return view('tests.questions.manage',compact('id'));
    }

    /**
     * Test Visiblity
     */
    public function visiblity(Test $test){
      if(Unit::unitActive($test->unit->id)){
        return Redirect()->back()->withErrors(['You are trying to modify an active unit. Modification of units is disabled while they are active.', '']);
      }
      Test::change_visibility($test->id);
      return redirect()->back();
    }

    /**
     * Delete Test
     */
    public function delete(Test $test){
      if(Unit::unitActive($test->unit->id)){
        return Redirect()->back()->withErrors(['You are trying to modify an active unit. Modification of units is disabled while they are active.', '']);
      }
      Test::deleteTest($test->id);
      return redirect()->back();
    }
}
