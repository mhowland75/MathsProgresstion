<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\Answer;
use Illuminate\Support\Facades\Storage;
use App\StudentsResult;
use App\Unit;

class TestController extends Controller
{
    public function view(Test $test){
      foreach($test->questions as $x){
        if(!empty($x->image)){
          $x->image = Storage::url($x->image);
        }else{
          $x->image = 0;
        }
      }
      return view('tests.view', compact('test'));
    }
    public function index($subject){
      $tests = Test::return_test_by_department($subject)->where('visibility',1)->get();;
      return view('tests.index',compact('tests'));
    }
    public function manage(Unit $unit_id){
      $tests = $unit_id->tests;
      return view('tests.manage',compact('tests','unit_id'));
    }
    public function create(){
      return view('tests.create');
    }
    public function store(request $request){
      $request->validate([
        'name' => 'required|unique:tests|max:30',
        'passmark' => 'required|integer',
      ]);
      //$filename = $request->image->getClientOriginalName();
      $data = new Test;
      $data->name = $request->name;
      $data->department = $request->department;
      $data->passmark = $request->passmark;
      $data->visibility = 0;
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
      return view('tests.questions.manage',compact('id'));
    }

    public function visiblity($id){
      Test::change_visibility($id);
      return redirect()->back();
    }
    public function delete($id){
      StudentsResult::delete_test($id);
      Test::destroy($id);
      return redirect()->back();
    }

    public function results(){
      return 'hello';
    }
}
