<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StudentLogin;
use App\Student;


class Student extends Model
{
    protected $table = 'students';

    public function studentLogin()
    {
        return $this->hasOne('App\StudentLogin','student_id', 'student_id');
    }
    public function studentResult()
    {
        return $this->hasMany('App\StudentsResult','student_id', 'student_id');
    }
    public static function get_student_details(){
        return static::where('student_id',StudentLogin::get_student_id())->get();

    }
    public static function listDepartments($year_id){
      $array = array();
      $departments = Student::select('dept')->where('student_year_id',$year_id)->get();
      foreach($departments as $department){
        if(!in_array($department->dept,$array)){
          $array[] = $department->dept;
        }
      }
      return $array;
    }
    public static function listCourseOfDepartment($year_id,$dept){
      $array = array();
      $courses = Student::select('course')->where('dept',$dept)->where('student_year_id',$year_id)->get();
      foreach($courses as $course){
        if(!in_array($course->course,$array)){
          $array[] = $course->course;
        }
      }
      return $array;
    }
    public static function listCoursesByDepartment($year_id){
      $departments = Student::listDepartments($year_id);
      $array = array();
      foreach($departments as $department){
        $array[$department] = Student::listCourseOfDepartment($year_id,$department);
      }
      return $array;
    }
    public static function getStudentInfo(){
      return Student::where('student_id',StudentLogin::get_student_id())->get();

    }
}
