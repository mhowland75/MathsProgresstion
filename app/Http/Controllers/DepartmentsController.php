<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\User;
use Auth;

class DepartmentsController extends Controller
{
    public function delete($id){
      Department::destroy($id);
      return redirect('/departments/index');
      
    }
    public function index(){
      $departments = Department::orderBy('course_name', 'asc')->get();
      //return $departments;
      foreach ($departments as $x) {
        $user = User::find($x->created_by);
        $x->created_by = $user->name;
        $user = User::find($x->updated_by);
        if(!$user){
          $x->updated_by = 'Never Updated';
        }else{
          $x->updated_by = $user->name;
        }
      }
      return view('departments.index', compact('departments'));
    }
    public function edit($id){
      $department = Department::find($id);
      return view('departments.edit',compact('department'));
    }
    public function update(request $request){
      $request->validate([
          'department' => 'required|max:50',
          'group_code' => 'required',
          'course_name' => 'required|max:50',

      ]);
      $department = Department::find($request->id);
      $department->course_name = $request->course_name;
      $department->group_code = $request->group_code;
      $department->department = $request->department;
      $department->updated_by = Auth::id();
      $department->save();
      return redirect('departments/index');
    }
    public function store(request $request){
      $request->validate([
          'department' => 'required|max:50',
          'group_code' => 'required',
          'course_name' => 'required|max:50',

      ]);
      $department = new department;
      $department->department = $request->department;
      $department->group_code = $request->group_code;
      $department->course_name = $request->course_name;
      $department->created_by = Auth::id();
      $department->save();
      return redirect('/departments/index');

    }
    public function create(){
      return view('departments.create');
    }
    public function view(){
      $results = Department::get();
      $departments = array();
      foreach($results as $result){
        if(!array_search($result->department, $departments)){
          $departments[] = $result->department;
        }
      }
      $results = array();
      foreach($departments as $department){
          $results[$department] = Department::where('department',$department)->get();
      }
      //return $results;
        return view('departments.view', compact('results'));
    }
}
