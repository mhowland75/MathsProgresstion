<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
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
  public function resultcsv()
    {
      $results = StudentsResult::all();
      //return $results[0]->test->unit->studentsYears->name;
      $filename = "tweets.csv";
      $handle = fopen($filename, 'w+');
      fputcsv($handle, array('student_id', 'student_name', 'student_year_name', 'unit_name', 'subject', 'test_name', 'passmark','correct_answers'));

      foreach($results as $result) {
        //return $result->test->subject->subject;
        $name = $result->student->firstname.' '.$result->student->surname;
          fputcsv($handle, array($result->student_id, $name, $result->test->unit->studentsYears[0]->name, $result->test->unit->name, $result->test->subject->subject, $result->test->name,$result->test->passmark,$result->correct_answers));
      }

      fclose($handle);

      $headers = array(
          'Content-Type' => 'text/csv',
      );
      return Response::download($filename, 'tweets.csv', $headers);
    }
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
    $year = StudentYear::find($year_id);
    $nav = Student::listCoursesByDepartment($year_id);
    $subjects = Subject::getSubjects();
    //return $subjects;
      $results = array();
      $students = Student::where('student_year_id',$year_id)->get();
      foreach($subjects as $subject){
        $results[$subject->subject]['unitResults'] = StudentsResult::studentoverallTestsResults($students,$subject);
        $results[$subject->subject]['testResults'] = StudentsResult::studentsTestResults($students,$subject);
      }
      //return $results;
    return view('tests.studentResults.index',compact('results','nav','year_id','subjects','year'));
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
        $results['unitResults'] = StudentsResult::studentoverallTestsResults($students,$c);
        $results['testResults'] = StudentsResult::studentsTestResults($students,$c);
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
    foreach($subjects as $subject){
      foreach($courses as $course){
        $students = Student::where('student_year_id',$year_id)->where('course',$course)->get();
        $results = array();
        $results['unitResults'] = StudentsResult::studentoverallTestsResults($students,$subject);
        $results['testResults'] = StudentsResult::studentsTestResults($students,$subject);
        $array[$subject->subject][$course] = $results;
      }
    }
    //return $array;
    return view('tests.studentResults.courseResults',compact('array','nav','year_id','department'));
  }
  public function studentsResults($year_id,$course){
    $nav = Student::listCoursesByDepartment($year_id);
    $subj = Subject::getSubjects();

    $array = array();
    foreach($subj as $subject){
      $s = Student::where('student_year_id',$year_id)->where('course',$course)->get();
      $results = StudentsResult::studentResults($s,$subject);
      $array[$subject->subject] = $results;
    }
    //return $array;
    return view('tests.studentResults.studentsResults',compact('tests','nav','year_id','course','array'));

  }
  public function resultsView(){
    $subj = Subject::getSubjects();
    $array = array();
    foreach($subj as $sub){
      $s = Student::where('student_id',StudentLogin::get_student_id())->get();
      $results = StudentsResult::studentResults($s,$sub);
      $array[$sub->subject] = $results;
    }
    //return $array;
    return view('tests.studentResults.results',compact('tests','nav','year_id','course','array'));
  }
}
