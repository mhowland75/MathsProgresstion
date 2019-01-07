<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\Answer;
use Illuminate\Support\Facades\Storage;
use App\StudentsResult;
use App\Unit;
use App\StudentYear;
use App\Student;
use App\Subject;
use App\StudentLogin;
class TestController extends Controller
{
    public function edit(Test $test){
      if(Unit::unitActive($test->unit->id)){
        return Redirect()->back()->withErrors(['You are unable to create, edit or delete any test, questions or answers whilst the unit is being actively used for students testing. Allowing this would corrupt the integrity of the students results. ', '']);
      }
      $subjects = Subject::getSubjects();
      //return $subjects;
      return view('tests.edit', compact('test','subjects'));
    }
    public function update(request $request, $id){
      $test = test::find($id);
      $test->name = $request->name;
      $test->subject_id = $request->subject_id;
      $test->department = 0;
      $test->passmark = $request->passmark;
      $test->save();
      return redirect('/test/'.$test->unit->id.'/manage');
    }
    public function view(Test $test){
      if(Test::studentTestVerification($test->id)){
        foreach($test->questions as $x){
          if(!empty($x->image)){
            $x->image = Storage::url($x->image);
          }else{
            $x->image = 0;
          }
        }
        return view('tests.view', compact('test'));
      }else {
        return redirect()->back();
      }
    }
    public function index(Subject $subject_id){
      $tests = Test::getStudentTests($subject_id);
      $results = Test::getStudentsTestsResults($tests);
      //$results[11]->test->passmark;
      $overallResults = Test::studentTestResultsSummery($results);
      $subject = ucfirst($subject_id->subject);
      //return $results;
      //$tests = Test::return_test_by_department($subject)->where('visibility',1)->get();
      return view('tests.index',compact('tests','results','subject', 'overallResults'));
    }
    public function manage(Unit $unit_id){
      $subjects = Subject::getSubjects();
    //  return $subjects;
      $array = array();
      foreach($subjects as $subject){
        $array[$subject->subject] = $unit_id->tests->where('subject_id',$subject->id);
      }
      return view('tests.manage',compact('array','subjects','unit_id'));
    }
    public function create(){
      return view('tests.create');
    }
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
    public function manageQuestions(Test $id){
      foreach($id->questions as $x){
        if(!empty($x->image)){
          $x->image = Storage::url($x->image);
        }else{
          $x->image = 0;
        }
      }
      //return $id;
      return view('tests.questions.manage',compact('id'));
    }

    public function visiblity(Test $test){
      if(Unit::unitActive($test->unit->id)){
        return Redirect()->back()->withErrors(['You are unable to create, edit or delete any test, questions or answers whilst the unit is being actively used for students testing. Allowing this would corrupt the integrity of the students results. ', '']);
      }
      Test::change_visibility($test->id);
      return redirect()->back();
    }
    public function delete(Test $test){
      if(Unit::unitActive($test->unit->id)){
        return Redirect()->back()->withErrors(['You are unable to create, edit or delete any test, questions or answers whilst the unit is being actively used for students testing. Allowing this would corrupt the integrity of the students results. ', '']);
      }
      Test::deleteTest($test->id);
      return redirect()->back();
    }

}
