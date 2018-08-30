<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;
use App\StudentLogin;
use App\StudentsResult;
use App\StudentsAnswer;
use App\StudentYear;
use App\Student;
use App\Test;


class StudentsResultsController extends Controller
{
  public function store(request $request){

    $question_id = array_keys($request->all());
    $question_id = $question_id[1];
    $test = Question::find($question_id)->test()->get();
    $testresults = StudentsResult::where('student_id',StudentLogin::get_student_id())->where('test_id',$test[0]->id)->get();
    if(!empty($testresults[0]->id)){
      $result = StudentsResult::where('student_id',StudentLogin::get_student_id())->where('test_id',$test[0]->id)->get();
      $result = $result[0];
      StudentsAnswer::where('results_id',$result->id)->delete();
    }else{
      $result = new StudentsResult;
    }
    $result->student_id = StudentLogin::get_student_id();
    $result->test_id = $test[0]->id;
    $result->correct_answers = Answer::get_test_results($request->all());;
    $result->total_questions = Question::count_question_in_test($test[0]->id);
    $result->attempt = 1;
    $result->save();
    foreach( $request->all() as $question_id => $answer_id){
      if($question_id == '_token'){
        continue;
      }
      $answer = new StudentsAnswer;
      $answer->results_id = $result->id;
      $answer->question_id = $question_id;
      $answer->answer_id = $answer_id;
      $answer->correct = Answer::get_is_answer_correct($question_id,$answer_id);
      $answer->save();
    }
    return redirect('/studentsResults/view/'.$result->test_id);
  }

  public function view($id){
     $studentResults = StudentsResult::get_student_results($id);
     //return $studentResults->student_answers;
    return view('tests.studentResults.view',compact('studentResults'));
  }
  public function index($year_id){
    $nav = Student::listCoursesByDepartment($year_id);
      $results = array();
      $students = Student::where('student_year_id',$year_id)->get();
      $results['maths']['unitResults'] = StudentsResult::studentoverallTestsResults($students,'maths');
      $results['maths']['testResults'] = StudentsResult::studentsTestResults($students,'maths');
      $results['english']['unitResults'] = StudentsResult::studentoverallTestsResults($students,'english');
      $results['english']['testResults'] = StudentsResult::studentsTestResults($students,'english');
      //return $results;
    return view('tests.studentResults.index',compact('results','nav','year_id'));
  }
  public function departmentResults($year_id){
    $nav = Student::listCoursesByDepartment($year_id);
    $array = array();
    $departments = Student::listDepartments($year_id);
    foreach($departments as $department){
      $students = Student::where('student_year_id',$year_id)->where('dept',$department)->get();
      $results = array();
      $results['maths']['unitResults'] = StudentsResult::studentoverallTestsResults($students,'maths');
      $results['maths']['testResults'] = StudentsResult::studentsTestResults($students,'maths');
      $results['english']['unitResults'] = StudentsResult::studentoverallTestsResults($students,'english');
      $results['english']['testResults'] = StudentsResult::studentsTestResults($students,'english');
  //  return $results;
      $array[$department] = $results;
    }
    //return $array;

    return view('tests.studentResults.departmentResults',compact('array','nav','year_id'));
  }
  public function courseResults($year_id,$department){
    $nav = Student::listCoursesByDepartment($year_id);
    $array = array();
    $courses = Student::listCourseOfDepartment($year_id,$department);
    foreach($courses as $course){
      $students = Student::where('student_year_id',$year_id)->where('course',$course)->get();
      $results = array();
      $results['maths']['unitResults'] = StudentsResult::studentoverallTestsResults($students,'maths');
      $results['maths']['testResults'] = StudentsResult::studentsTestResults($students,'maths');
      $results['english']['unitResults'] = StudentsResult::studentoverallTestsResults($students,'english');
      $results['english']['testResults'] = StudentsResult::studentsTestResults($students,'english');
  //  return $results;
      $array[$course] = $results;
    }
    //return $array;
    return view('tests.studentResults.courseResults',compact('array','nav','year_id'));
  }
  public function studentsResults($year_id,$course){
    $nav = Student::listCoursesByDepartment($year_id);
    $students = Student::where('student_year_id',$year_id)->where('course',$course)->get();
    $eResults = StudentsResult::studentResults($students,'english');
    $students = Student::where('student_year_id',$year_id)->where('course',$course)->get();
    $mResults = StudentsResult::studentResults($students,'maths');
    $students = array('maths' => $mResults, 'english'=>$eResults);

    //return $students;
    return view('tests.studentResults.studentsResults',compact('students','tests','nav','year_id','course'));

  }

}
