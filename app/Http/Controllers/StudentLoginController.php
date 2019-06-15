<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudentLogin;
use Session;

class StudentLoginController extends Controller
{
    public function view(StudentLogin $id){
      return $id;
    }
    public function loginView(){
      return view('student_login.login');
    }

    public function login(Request $request){
      $request->validate([
          'student_id' => 'required|min:8|max:12',
          'password' => 'required|min:8|max:15',
      ]);

      if(StudentLogin::studentAuth($request->student_id,$request->password)){
        StudentLogin::start_student_session($request->student_id);
      }
      else{
        session()->flash('msg', 'Incorrect Student ID or Password.');
        return redirect()->back();
      }
      if(StudentLogin::password_reset_status($this->get_student_id())){
        return redirect('/');
      }
      else{
        return redirect('/student/password_reset');
      }
    }

    public function logout(){
      StudentLogin::end_student_session();
      return redirect('/');
    }

    public function password_reset_view(){
      return view('student_login.password_reset');
    }
    public function password_reset(request $request){
      $request->validate([
          'new_password' => 'required|min:8|max:12',
          'con_password' => 'required|min:8|max:12',
      ]);
      if($request->new_password === $request->con_password){
        if($request->new_password !== StudentLogin::get_student_id()){
          if(preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $request->new_password)) {
            StudentLogin::student_password_update(StudentLogin::get_student_id(),$request->new_password);
            return redirect('/');
          }
        }
      }
        return redirect()->back();
    }


    public function start_student_session($student_id){
        Session::put('student_id', $student_id);
    }
    public function end_student_session(){
        Session::forget(static::get_student_id());
    }
    public function get_student_id(){
      return Session::get('student_id');
    }

}
