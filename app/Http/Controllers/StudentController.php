<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use DB;

class StudentController extends Controller
{
  public function create(){
    return view('student.create');
  }
  public function index(){
    $data = Student::paginate(100);
    return view('student.index',compact('data'));
  }
  public function store(request $request){
    if($request->data == 1){
      Student::truncate();
    }
    $filename = $request->students->getClientOriginalName();
    $request->students->storeAs('public/csv/', $filename);
    $file = file_get_contents("storage/csv/".$filename);

    $data = array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $file));
    //echo'<pre>';
   // print_r($data);
    foreach($data as $line){

      if(!empty($line[1])){
        DB::table('students')
           ->insert([
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
      }
    }
    return redirect('/student/index');
  }
}
