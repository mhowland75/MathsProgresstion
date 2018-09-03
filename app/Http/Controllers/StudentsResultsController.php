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
use App\Subject;
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
    $subjects = Subject::getSubjects();
    //return $subjects;
      $results = array();
      $students = Student::where('student_year_id',$year_id)->get();
      foreach($subjects as $subject){
        
        $results[$subject->subject]['unitResults'] = StudentsResult::studentoverallTestsResults($students,$subject->subje);
        $results[$subject->subject]['testResults'] = StudentsResult::studentsTestResults($students,$subject->subject);
      }
      //return $results;
    return view('tests.studentResults.index',compact('results','nav','year_id','subjects'));
  }
  public function departmentResults($year_id){
    $nav = Student::listCoursesByDepartment($year_id);
    $array = array();
    $departments = Student::listDepartments($year_id);
    $subjects = Subject::getSubjects();
    foreach($subjects as $subject => $c){
      foreach($departments as $department){
        $students = Student::where('student_year_id',$year_id)->where('dept',$department)->get();
        $results = array();
        $results['unitResults'] = StudentsResult::studentoverallTestsResults($students,$c->subject);
        $results['testResults'] = StudentsResult::studentsTestResults($students,$c->subject);
        $array[$c->subject][$department] = $results;
      }
    }
    //return $array;

    return view('tests.studentResults.departmentResults',compact('array','nav','year_id','subjects'));
  }
  public function courseResults($year_id,$department){
    $nav = Student::listCoursesByDepartment($year_id);
    $array = array();
    $courses = Student::listCourseOfDepartment($year_id,$department);
    $subjects = Subject::getSubjects();
    foreach($subjects as $subject => $c){
      foreach($courses as $course){
        $students = Student::where('student_year_id',$year_id)->where('course',$course)->get();
        $results = array();
        $results['unitResults'] = StudentsResult::studentoverallTestsResults($students,$c->subject);
        $results['testResults'] = StudentsResult::studentsTestResults($students,$c->subject);
        $array[$c->subject][$course] = $results;
      }
    }
    //return $array;
    return view('tests.studentResults.courseResults',compact('array','nav','year_id'));
  }
  public function studentsResults($year_id,$course){
    $nav = Student::listCoursesByDepartment($year_id);
    $subj = Subject::getSubjects();

    $array = array();
    foreach($subj as $sub =>$c){
      $s = Student::where('student_year_id',$year_id)->where('course',$course)->get();
      $results = StudentsResult::studentResults($s,$c->subject);
      $array[$c->subject] = $results;
    }
    //return $array;
    return view('tests.studentResults.studentsResults',compact('tests','nav','year_id','course','array'));

  }

}
