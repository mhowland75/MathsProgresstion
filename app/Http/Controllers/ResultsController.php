<?php

namespace App\Http\Controllers;
use App\Results;
use App\Student;
use Illuminate\Http\Request;
use DB;

class ResultsController extends Controller
{
    public function passMarkView(){

      $passMark = DB::table('pass_mark')->select('pass_mark')->first();
      if(count($passMark) > 0){
        $passMark = $passMark->pass_mark;
      }
      else {
        $passMark = 30;
      }

      return view('results.stats.passMark', compact('passMark'));
    }
    public function storePassMark(request $request){
      /*$request->validate([
          'name' => 'required|max:50|min:4',
          'introduction' => 'required|max:500',
          'explanation' => 'required|max:5000|min:500',
          'image' => 'required|image',
      ]);*/
      $passMark = DB::table('pass_mark')->select('pass_mark')->first();
      if(!$passMark){
        DB::table('pass_mark')
           ->insert([
             'pass_mark' => $request->passMark,
           ]);
      }else{
        DB::table('pass_mark')
           ->update([
             'pass_mark' => $request->passMark,
           ]);
      }

      return redirect('/results/passMark');
    }
    public function returnPassMark(){
        $passMark = DB::table('pass_mark')->select('pass_mark')->first();
        if(!$passMark){
          return 30;
        }else{
          return $passMark->pass_mark;
        }

    }
    public function listQuizzes(){
      $quizNames = Results::select('quiz_name')->get();
      $array = array();
      foreach($quizNames as $quizName){
        if (!in_array($quizName, $array))
          {
            $array[] = $quizName;
          }
      }
      return $array;
    }
    public function deptView(request $request){
      $nav = $this->listCoursesByDept();
      $dpts = $this->listDepartments();
      $testStats = $this->StatsTests();
      $quizes = $this->StatsQuizes();
      $array = array();
      foreach($dpts as $dpt){
        $array[$dpt]['quizes'] = $quizes[$dpt];
        $array[$dpt]['Tests'] = $testStats[$dpt];
      }
      return view('results.stats.department2',compact('array','nav'));
    }
    public function courseView(request $request,$dept){

      $nav = $this->listCoursesByDept();
      $dpts = $this->listDepartments('course',$dept);
      $testStats = $this->StatsTests('course',$dept);
      $quizes = $this->StatsQuizes('course',$dept);
      $com = $this->StatsStudentCom('course',$dept);
      $array = array();
      foreach($dpts as $dpt){
        $array[$dpt]['quizes'] = $quizes[$dpt];
        $array[$dpt]['Tests'] = $testStats[$dpt];
        $array[$dpt]['com'] = $com[$dpt];
      }
      return view('results.stats.course2',compact('array','dept','nav'));
    }
    public function studentView($course){
        $nav = $this->listCoursesByDept();
       $results = $this->listStudentResultsByCourse($course);
       $department = Student::select('dept')->where('course',$course)->first();
       $navDept = $this->listDepartments();
       $navCourse = $this->listDepartments('course','all');
       $department = $department->dept;
       $quizList = $this->listQuizzes();
       $noSpaceQuizList = array();
       foreach($quizList as $quiz){
         $noSpaceQuizList[] = str_replace(' ','',$quiz['quiz_name']);
       }
      return view('results.stats.student2',compact('results','course','department','nav','noSpaceQuizList','quizList'));
    }
    public function studentDetails($studentId){
      $nav = $this->listCoursesByDept();
      $sDetails = Student::select()->where('student_id',$studentId)->get();
      $results = Results::select()->where('student_id',$studentId)->get();
      $array = array();
      $passed = 0;
      $incompleate = 0;
      foreach($results as $result){
        $c = $this->cleanResult($result->results);
        if($c['score'] >= $this->returnPassMark()){
          $result->results = '<p style="color:green; font-size:12px">'.$c['score'].'/'.$c['outOf'].'</p>';
          $passed++;
        }else{
          $result->results = '<p style="color:red; font-size:12px">'.$c['score'].'/'.$c['outOf'].'</p>';
          $incompleate++;
        }
        $array[str_replace(' ','',$result->quiz_name)] = array('result'=>$result->results,
        'startDate'=>'<p style="font-size:12px">'.$result->start_date.'</p>',
        'dateStarted'=>'<p style="font-size:12px">'.$result->date_started.'</p>',
        'dateCom'=>'<p style="font-size:12px">'.$result->date_completed.'</p>',
        'dateDue'=>'<p style="font-size:12px">'.$result->date_due.'</p>',
      );
      }
      //return $sDetails;
      //return $array;
      $quizList = $this->listQuizzes();
      $noSpaceQuizList = array();
      foreach($quizList as $quiz){
        $noSpaceQuizList[] = str_replace(' ','',$quiz['quiz_name']);
      }
      //return   $noSpaceQuizList;
      return view('results.stats.studentDetails',compact('sDetails','array','nav', 'quizList','noSpaceQuizList','passed','incompleate'));
    }
    public function overAllstats2(){
      $totalStudents =  Student::select()->count();
      $attemptedQuizes = Results::select()->count();
      $totalQuizes = $totalStudents * count($this->listQuizzes());
      $quizesLeft = $totalQuizes - $attemptedQuizes;
      $sIds = Student::select('student_id')->get();
      $passedStudents = 0;
      $comTests = 0;
      $attemptedTests = 0;
      foreach($sIds as $id){
        $results = Results::select('results','completed')->where('student_id', $id->student_id)->get();
        $g = 0;
        $e = 0 ;
        $d = 0;
        foreach($results as $result){
          $score = $this->cleanResult($result->results);
          if($score['score'] >= $this->returnPassMark() && $result->completed == 'Yes'){
            $g++;
          }
          if($result->completed == 'Yes'){
            $e++;
          }
          $d++;
        }

        if($g == count($this->listQuizzes())){
          $passedStudents++;
        }
        if($e == count($this->listQuizzes())){
          $comTests++;
        }
        if($d > 0){
          $attemptedTests++;
        }
      }
      $results = Results::select('results')->get();
      $passedQuizes = 0;
      foreach($results as $result){
        $result = $this->cleanResult($result->results);
        if($result['score'] >= $this->returnPassMark()){
          $passedQuizes++;
        }
      }
      $perPassedQuizes = round($passedQuizes/$totalQuizes * 100,2);
      $perStudentsPassed = round($passedStudents/$totalStudents * 100,2);
      $perQuizesLeft = round($attemptedQuizes/$totalQuizes * 100 , 2);
      $attmptedButIncomQuizes = Results::select()->where('completed','No')->count();
      $comQuizes = $attemptedQuizes - $attmptedButIncomQuizes;
      $perQuizesCom = round($comQuizes/$totalQuizes * 100,2);
      $perQuizesAttempted = round($attemptedQuizes/$totalQuizes * 100,2);
      $perComTests = round($comTests/$totalStudents * 100,2);
      $perAttemptedTests = round($attemptedTests/$totalStudents * 100,2);
      return array(
        'totalStudents'=>$totalStudents,
        'totalQuizes'=>$totalQuizes,
        'attemptedQuizes'=>$attemptedQuizes,
        'quizesLeft'=>$quizesLeft,
        'passedStudents'=>$passedStudents,
        'perPassedStudents'=>$perStudentsPassed,
        'attmptedButIncomQuizes'=>$attmptedButIncomQuizes,
        'comQuizes'=> $comQuizes,
        'perQuizesCom'=>$perQuizesCom,
        'perQuizesAttempted'=>$perQuizesAttempted,
        'passedQuizes'=>$passedQuizes,
        'perPassedQuizes'=>$perPassedQuizes,
        'comTests'=>$comTests,
        'perComTests'=>$perComTests,
        'attemptedTests'=>$attemptedTests,
        'perAttemptedTests'=>$perAttemptedTests,
      );
    }
    public function overallStatsView(){
      $array = $this->overAllstats2();
      $nav = $this->listCoursesByDept();
      $passMark = $this->returnPassMark();
      return view('results.stats.overallStats',compact('array','nav','passMark'));
    }
    public function create(){
      return view('results.create');
    }
    public function index(){
      //return $this->findId();
      $data = Results::paginate(100);
      return view('results.index',compact('data'));
    }
    public function listStudentResultsByCourse($course){
      $array = array();
       $sids = Student::select('student_id','firstname','surname')->where('course',$course)->get();
       foreach($sids as $sid){
        $name = $sid->firstname.' '.$sid->surname;
        $sResults = Results::select('results','quiz_name','completed')->where('student_id',$sid->student_id)->get();
         $e = array();
         $s = 0;
         $comQuizes = 0;
         foreach($sResults as $r){
            $result = $this->cleanResult($r->results);
            if($result['score'] >= $this->returnPassMark() && $r->completed == 'Yes'){
              $s++;
            }
            if($r->completed == 'Yes'){
              $comQuizes++;
            }
            $r->results = $result['score'].'/'.$result['outOf'];
            $e['name'] = $name;
            if($r->results >= $this->returnPassMark() && $r->completed == 'Yes'){
              $results = '<p style="color:#2be973">'.$r->results.'</p>';
            }
            elseif($r->results < $this->returnPassMark() && $r->completed == 'Yes'){
              $results = '<p style="color:red">'.$r->results.'</p>';
            }
            elseif($r->completed == 'No'){
              $results = '<p style="color:purple">'.$r->results.'</p>';
            }
            if($s == count($this->listQuizzes())){
              $passedTest = '<p style="color:green">Passed</p>';
            }
            elseif($comQuizes == count($this->listQuizzes()) && $s < count($this->listQuizzes())){
              $passedTest = '<p style="color:red">Incomplete</p>';
            }
            elseif($comQuizes < count($this->listQuizzes())){
                $passedTest = '<p style="color:purple">Incomplete</p>';
            }
            $e[str_replace(' ','',$r->quiz_name)] = $results;
            $e['passedTest'] = $passedTest;
            $e['passedQuizes'] = $s;
            $e['comQuizes'] = $comQuizes;
            $e['attemptedQuizes'] = count($sResults);
         }
          $array[$sid->student_id] = $e;
       }
       return $array;
    }
    public function listDepartments($dataType = 'dept',$department=0){
      if($dataType == 'dept'){
          $data = Student::select($dataType)->get();
      }elseif($dataType == 'course' && !$department == 0){
        if($department == 'all'){
            $data = Student::select($dataType)->get();
        }else{
            $data = Student::select($dataType)->where('dept',$department)->get();
        }
      }else{
        return 'invalid';
      }
      $dept = array();
      $departments =array();
      foreach($data as $x){
        if($dataType == 'dept'){
          $dept[] = $x->dept;
        }else{
            $dept[] = $x->course;
        }
          foreach($dept as $y){
            //sorts list into individual instances in the list
            if (!in_array($y, $departments))
              {
                $departments[] = $y;
              }
          }
      }
      return $departments;
    }
    public function listCoursesByDept(){
      $departments = $this->listDepartments();
      $array = array();
      foreach($departments as $department){
        $courses = $this->listDepartments('course',$department);
        $array[$department] = $courses;
      }
      return $array;
    }
    public function studentsIdByDepartment($dataType = 'dept',$department=0){
      $dpts = $this->listDepartments($dataType,$department);
      $deptStudent_ids = array();
      foreach($dpts as $dpt){
        if($dataType == 'dept'){
          $student_ids = Student::select('student_id')->where('dept',$dpt)->get();
        }else{
          $student_ids = Student::select('student_id')->where('course',$dpt)->get();
        }
        $x = array();
        foreach($student_ids as $sid){
          $x[] = $sid->student_id;
        }
        $deptStudent_ids[$dpt] = $x;
      }
      return $deptStudent_ids;
    }
    public function StatsStudentCom($dataType = 'dept',$department=0){
      $student_ids = $this->studentsIdByDepartment($dataType,$department);
      $array = array();
      foreach($student_ids as $dpt =>$sids){
        $total = 0;
        $incom = 0;
        foreach($sids as $sid){
          $total++;
          $studentResults = Results::select('results','completed')->where('student_id',$sid)->get();
          //return $studentResults;
          if(count($studentResults) == count($this->listQuizzes())){
            foreach($studentResults as $sr){
              if(strtolower($sr->completed) == 'no'){
                $incom++;
                break;
              }
            }

          }else{
            $incom++;
          }
          $percentageIncompleate = $incom / $total * 100;
          $percentageCompleate = 100 - $percentageIncompleate;
          $array[$dpt] = array('dpt'=>$dpt,'incom'=>$incom, 'total'=>$total,'incomPer'=>round($percentageIncompleate,2),'comPer'=>round($percentageCompleate,2));

        }
      }
      return $array;
    }
    public function StatsQuizes($dataType = 'dept',$department=0){
      //calculates the passrate percentage of all attmpted quizes
      $student_ids = $this->studentsIdByDepartment($dataType,$department);
      $array = array();
      foreach($student_ids as $dpt=>$sids){
        $totalStudents = count($sids);
        $totalQuiz = $totalStudents * count($this->listQuizzes());
        $attemptedQuizes = 0;
        foreach($sids as $sid){
          $studentResults = Results::select('results','completed')->where('student_id',$sid)->get();
          //return $studentResults;
          foreach($studentResults as $sr){
            //return $sr;
              $attemptedQuizes++;
            if(strtolower($sr->completed) == 'yes'){
              $cResults = $this->cleanResult($sr->results);
              $array[$dpt][] = $cResults['score'];
              $array[$dpt]['totalQuiz'] = $totalQuiz;
            }
            //return $sr;
          }

        }
        $array[$dpt]['attmptedQuiz'] = $attemptedQuizes;
      }
      //return $array;

      $fr = array();
      foreach($array as $dpt=>$re){
        $total = count($re) - 2;
        $i = 0;
        foreach ($re as $key=>$result){
          //return $re;
          if(!$key == 0){
            if($key =='totalQuiz' || $key =='attmptedQuiz'){
              continue;
            }
          }
          if($result >= $this->returnPassMark()){
            $i++;
          }
        }
        $per = $i/$re['totalQuiz'] * 100;
        $perAttemptedQuizes = $re['attmptedQuiz']/$re['totalQuiz'] *100;
        $perComQuiz = $total / $re['totalQuiz'] *100;
        $fr[$dpt] = array('dpt'=>$dpt,
        'passedOfCom'=>$i,
        'totalCom'=>$total,
        'passPerOfCom'=>round($per,2),
        'totalQuiz'=>$re['totalQuiz'],
        'AttemptedQuizes'=>$re['attmptedQuiz'],
        'perAttemptedQuizes'=>round($perAttemptedQuizes,2),
        'perComQuiz'=>round($perComQuiz, 2));
      }
      return $fr;
    }
    public function StatsTests($dataType = 'dept',$department=0){
      //finds the percentage passed of student who have attempted all the tests
      $student_ids = $this->studentsIdByDepartment($dataType,$department);
      $array = array();
      foreach($student_ids as $dpt=>$sids){
        $total = count($sids);
        $passed = 0;
        $totalCom = 0;
        $attemptedTests = 0;
        foreach($sids as $sid){
          $studentResults = Results::select('results','completed')->where('student_id',$sid)->get();
          $rco = count($studentResults);
          $i = 0;
          if($rco == count($this->listQuizzes())){
            $totalCom++;
            foreach($studentResults as $sr){
              $cResult =  $this->cleanResult($sr->results);
              if($cResult['score'] >= $this->returnPassMark()){
                $i++;
              }else{
                break;
              }
              if($i == count($this->listQuizzes())){
                $passed++;
              }
            }
          }
          if(count($studentResults) > 0){
            $attemptedTests++;
          }
        }
        $perAttemptedTests = round($attemptedTests/$total*100,2);
        $per = $passed/$total * 100;
        if(!$passed){
          $perPassOfCom = 0;
        }else{
          $perPassOfCom = $passed/$totalCom * 100;
        }
        $perCom = round($totalCom/$total*100,2);
        $array[$dpt] = array('dpt'=>$dpt,
        'passedTests'=>$passed,
        'total'=>$total,
        'totalCom'=>$totalCom,
        'percPassed'=>round($per,2),
        'perPassOfCom'=>round($perPassOfCom,2),
        'perCom'=>$perCom,
        'attemptedTests'=>$attemptedTests,
        'perAttemptedTests'=>$perAttemptedTests,
      );
      }
      return $array;
    }
    public function store(request $request){

      if($request->data == 1){
        Results::truncate();
      }

      $filename = $request->results->getClientOriginalName();
      $request->results->storeAs('public/csv/', $filename);
      $file = file_get_contents("storage/csv/".$filename);

      $data = array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $file));
      //echo'<pre>';
     // print_r($data);
      foreach($data as $line){
        if(!empty($line[1])){
          DB::table('results')
             ->insert([
               'student_id' => $line['0'],
            'student_name' => $line['1'],
             'completed' => $line['2'],
             'results' => $line['3'],
             'start_date' => $line['4'],
             'date_started' => $line['5'],
             'date_completed' => $line['6'],
             'date_due' => $line['7'],
             'quiz_name' => $line['8'],

           ]);
        }
      }
      return redirect('/results/index');
    }
    public function findDuplicates($results, $students){
      $e = array();
      foreach($students as $student){
        $m[] = $student->firstname.''.$student->surname;
      }
      $students = $m;
      $dup = array();
      foreach ($students as $student){
        $i = 0;
        foreach($students as $c){
          if($student == $c){
            if($i == 1){
              if(!in_array($c,$dup)){
                $dup[] = $c;
              }
            }
              $i++;
          }
        }
      }
      return $dup;
    }
    public function findId(){
      $results = results::select('student_name')->get();
      $students =  student::select('student_id','firstname','surname')->get();

      foreach($students as $student){
        $student->student_name = $student->firstname.''.$student->surname;
        foreach($results as $result){
          if(!strcmp($student->student_name,$result->student_name)){
              $result->student_id = $student->student_id;
          }
        }
      }
      foreach($results as $result){
        Results::where("student_name",$result->student_name)->update(['student_id'=>$result->student_id]);
      }
      $dups = $this->findDuplicates($results,$students);
      foreach($dups as $dup){
        Results::where('student_name',$dup)->update(['student_id'=>'']);
      }

    }
    public static function cleanResult($result){
      $result = trim($result,"'/ /");
      $score = substr($result,0,2);
      $outOf = substr($result,3,2);
      return array('score'=> $score, 'outOf'=>$outOf);
    }


}
