<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\StudentYear;
use App\StudentLogin;
use DB;

class StudentController extends Controller
{
  public function edit($student){
    $data =  Student::find($student);
    return view('student.edit', compact('data'));
  }

  public function update(request $request){
    $x = Student::find($request->id);
    $x->student_year_id = $x->student_year_id;
    $x->student_id = $request->student_id;
    $x->firstname = $request->firstname;
    $x->surname = $request->lastname;
    $x->dob = $request->dob;
    $x->primary_tutor = $request->tutor;
    $x->dept = $request->department;
    $x->course = $request->course;
    $x->gcse_maths_grade = $request->maths_grade;
    $x->withdrawn = $request->withdrawn;
    $x->save();
    return redirect()->back();
  }

  public function storeStudent(request $request){
    $student = Student::where('student_id',$request->student_id)->get();
    if(!empty($student->id)){
      return redirect()->back()->withErrors(['Student_id '.$request->student_id.' already exits in the databace']);
    }
    $request->validate([
        'student_id' => 'required|max:14|min:10',
        'firstname' => 'required|max:50',
        'lastname' => 'required|max:50',
        'tutor' => 'required',
        'department' => 'required',
        'course' => 'required',
        'withdrawn' => 'required',
    ]);
    $x = new Student;
    $x->student_year_id = $request->year;
    $x->student_id = $request->student_id;
    $x->firstname = $request->firstname;
    $x->surname = $request->lastname;
    $x->dob = $request->dob;
    $x->primary_tutor = $request->tutor;
    $x->dept = $request->department;
    $x->course = $request->course;
    $x->gcse_maths_grade = $request->maths_grade;
    $x->withdrawn = $request->withdrawn;
    $x->save();

    $data = new StudentLogin;
    $data->student_id = $request->student_id;
    $data->student_year_id = $request->year;
    $data->password = bcrypt($request->student_id);
    $data->password_reset = 0;
    $data->active = 0;
    $data->save();

    return redirect()->back();
  }
  public function store(request $request){
    //return $request;
    if($request->data == 1){
      Student::truncate();
    }
    $filename = $request->students->getClientOriginalName();
    $request->students->storeAs('public/csv/', $filename);
    $file = file_get_contents("storage/csv/".$filename);
    $data = array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $file));
    foreach($data as $line){
      $student = Student::where('student_id',$line['0'])->get();
      if(!empty($student->id)){
        return redirect()->back()->withErrors(['Student_id '.$line[0].' already exits in the databace']);
      }
    }
    foreach($data as $line){
      if(!empty($line[1])){
        DB::table('students')
           ->insert([
             'student_year_id' => $request->year,
          'student_id' => $line['0'],
          'firstname' => $line['1'],
           'surname' => $line['2'],
           'dob' => $line['3'],
           'dept' => $line['4'],
           'course' => $line['5'],
           'gcse_maths_grade' => $line['6'],
           'primary_tutor' => $line['7'],
           'withdrawn' => $line['8'],

         ]);
         $data = new StudentLogin;
         $data->student_id = $line['0'];
         $data->student_year_id = $request->year;
         $data->password = bcrypt($line['0']);
         $data->password_reset = 0;
         $data->active = 1;
         $data->save();
      }
    }
    return redirect('/student_year/'.$request->year.'/edit');
  }
  public function delete($student_id){
    Student::where('student_id',$student_id)->delete();
    StudentLogin::where('student_id',$student_id)->delete();
    return redirect()->back();
  }
  public function DeleteAllByStudentYear($year){
    $students = Student::where('student_year_id', $year)->get();
    foreach($students as $student){
      StudentLogin::where('student_id',$student->student_id)->delete();
    }
    $students->delete();
    return redirect()->back();
  }
  public function activate($studentId){
    $student = StudentLogin::where('student_id',$studentId)->get();
    //return $student;
    if(!empty($student[0]->id)){
      if($student[0]->active){
        $student[0]->active = 0;
      }else{
        $student[0]->active = 1;
      }
      $student[0]->save();
    }else{
      return redirect()->back();
    }
    return redirect()->back();
  }
}
