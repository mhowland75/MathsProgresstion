<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use App\StudentYear;
use App\Student;
use App\StudentsResult;

class StudentYearController extends Controller
{
    public function manage(){
      $years = StudentYear::all();
      $units = Unit::all();
      //return $units;
      return view('student_year.manage',compact('units','years'));
    }
    public function store(request $request){
      $data = new StudentYear;
      $data->name = $request->name;
      $data->unit_id = $request->unit_id;
      $data->description = $request->description;
      $data->student_login_active = 0;
      $data->active = 1;
      $data->save();
      return redirect()->back();
    }
    public function activateStudentLogins(StudentYear $year){
      StudentYear::activateLogins($year->id);
      return redirect()->back();
    }
    public function edit(StudentYear $year){
      $units = Unit::all();
      $data = Student::where('student_year_id',$year->id)->paginate(100);
      return view('student_year.edit',compact('units','year','data'));
    }
    public function update(Request $request,StudentYear $year){
      $data = StudentYear::find($year->id);
      $data->name = $request->name;
      $data->description = $request->description;
      $data->unit_id = $request->unit_id;
      $data->save();
      return redirect()->back();
    }
    public function delete(StudentYear $year){
      StudentsResult::deleteStudentResultsByYear($year->id);
      StudentYear::StudentYearDelete($year->id);
      return redirect()->back();
    }
    public function studentResultsReset(StudentYear $year){
      StudentsResult::deleteStudentResultsByYear($year->id);
      return redirect()->back();
    }
}
