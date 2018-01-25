<?php

namespace App\Http\Controllers;
use App\Results;
use App\Student;
use Illuminate\Http\Request;
use DB;

class ResultsController extends Controller
{
    private $passMark = 30;
    public function deptView(request $request){
      $nav = $this->listCoursesByDept();
      $dpts = $this->listDepartments();
      $testStats = $this->StatsTests();
      /*
      usort($testStats, function($a, $b) {
          return $b['passedTests'] <=> $a['passedTests'];
      });
      $er =array();

      foreach($testStats as $r){
        $er[$r['dpt']] = $r;
      }*/

      $quizes = $this->StatsQuizes();
      $array = array();
      foreach($dpts as $dpt){
        $array[$dpt]['quizes'] = $quizes[$dpt];
        $array[$dpt]['Tests'] = $testStats[$dpt];
      }
      //return $array;

      /*return $array;
      $array = $this->overallStats();
      $data = $this->departmentStats();
      if($request->sort == "pl"){
        usort($data, function($a, $b) {
            return $a['pass'] <=> $b['pass'];
        });
        $sort = $request->sort;
      }
      elseif($request->sort == "ph"){
        usort($data, function($a, $b) {
            return $b['pass'] <=> $a['pass'];
        });
        $sort = $request->sort;
      }
      elseif($request->sort == "cl"){
        usort($data, function($a, $b) {
            return $a['compleate'] <=> $b['compleate'];
        });
        $sort = $request->sort;
      }
      elseif($request->sort == "ch"){
        usort($data, function($a, $b) {
            return $b['compleate'] <=> $a['compleate'];
        });
        $sort = $request->sort;
      }
      else{
        $sort = 'pl';
      }*/
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
      /*
      $data = $this->courseStats($dept);
      foreach($data as $r => $v){
        $data[$r]['classname'] = $r;
      }
      if($request->sort == "pl"){
        usort($data, function($a, $b) {
            return $a['percentPass'] <=> $b['percentPass'];
        });
        $sort = $request->sort;
      }
      elseif($request->sort == "ph"){
        usort($data, function($a, $b) {
            return $b['percentPass'] <=> $a['percentPass'];
        });
        $sort = $request->sort;
      }
      elseif($request->sort == "cl"){
        usort($data, function($a, $b) {
            return $a['studentsComplete'] <=> $b['studentsComplete'];
        });
        $sort = $request->sort;
      }
      elseif($request->sort == "ch"){
        usort($data, function($a, $b) {
            return $b['studentsComplete'] <=> $a['studentsComplete'];
        });
        $sort = $request->sort;
      }
      else{
        $sort = 'pl';
      }
      */
      //return $array;
      return view('results.stats.course2',compact('array','dept','nav'));
    }
    public function studentView($course){
        $nav = $this->listCoursesByDept();
       $results = $this->listStudentResultsByCourse($course);
       $department = Student::select('dept')->where('course',$course)->first();
       $navDept = $this->listDepartments();
       $navCourse = $this->listDepartments('course','all');
       $department = $department->dept;
      /*
      $data = Student::select('student_id','dept')->where('course',$course)->get();
      $dept =  $data[0]->dept;
      $f = array();
      foreach($data as $t){
        $f[] = Results::where('student_id',$t->student_id)->get();
      }
      //return $f;
      foreach($f as $d){
        $r = $this->cleanResult($d[0]->results);
        $d[0]->results = $r['score'].' / '.$r['outOf'];
      }
      */
      return view('results.stats.student2',compact('results','course','department','nav'));
    }
    public function studentDetails($studentId){
      $nav = $this->listCoursesByDept();
      $sDetails = Student::select()->where('student_id',$studentId)->get();
      $results = Results::select()->where('student_id',$studentId)->get();
      $array = array();
      foreach($results as $result){
        $c = $this->cleanResult($result->results);
        if($c['score'] >= $this->passMark){
          $result->results = '<p style="color:green">'.$c['score'].'/'.$c['outOf'].'</p>';
        }else{
          $result->results = '<p style="color:red">'.$c['score'].'/'.$c['outOf'].'</p>';
        }
        $array[str_replace(' ','',$result->quiz_name)] = array('result'=>$result->results,
        'startDate'=>$result->start_date,
        'dateStarted'=>$result->date_started,
        'dateCom'=>$result->date_completed,
        'dateDue'=>$result->date_due,
      );
      }
      //return $sDetails;
      //return $array;
      return view('results.stats.studentDetails',compact('sDetails','array','nav'));
    }
    public function overAllstats2(){
      $nav = $this->listCoursesByDept();
      $totalStudents =  Student::select()->count();
      $attemptedQuizes = Results::select()->count();
      $totalQuizes = $totalStudents * 9;
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
          if($score['score'] >= $this->passMark && $result->completed == 'Yes'){
            $g++;
          }
          if($result->completed == 'Yes'){
            $e++;
          }
          $d++;
        }

        if($g == 9){
          $passedStudents++;
        }
        if($e == 9){
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
        if($result['score'] >= $this->passMark){
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
      $totalTests =
      $array = array(
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
      //return $array;
        return view('results.stats.overallStats',compact('array','nav'));
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
            if($result['score'] >= $this->passMark && $r->completed == 'Yes'){
              $s++;
            }
            if($r->completed == 'Yes'){
              $comQuizes++;
            }
            $r->results = $result['score'].'/'.$result['outOf'];
            $e['name'] = $name;
            if($r->results >= $this->passMark && $r->completed == 'Yes'){
              $results = '<p style="color:#2be973">'.$r->results.'</p>';
            }
            elseif($r->results < $this->passMark && $r->completed == 'Yes'){
              $results = '<p style="color:red">'.$r->results.'</p>';
            }
            elseif($r->completed == 'No'){
              $results = '<p style="color:purple">'.$r->results.'</p>';
            }
            if($s == 9){
              $passedTest = '<p style="color:green">Passed</p>';
            }
            elseif($comQuizes == 9 && $s < 9){
              $passedTest = '<p style="color:red">Failed</p>';
            }
            elseif($comQuizes < 9){
                $passedTest = '<p style="color:purple">Incompleate</p>';
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
          if(count($studentResults) == 9){
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
        $totalQuiz = $totalStudents * 9;
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
        foreach ($re as $result){
          //return $re;
          if($result >= $this->passMark){
            $i++;
          }
        }
        $per = $i/$total * 100;
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
          if($rco == 9){
            $totalCom++;
            foreach($studentResults as $sr){
              $cResult =  $this->cleanResult($sr->results);
              if($cResult['score'] >= $this->passMark){
                $i++;
              }else{
                break;
              }
              if($i == 9){
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
        $perPassOfCom = $passed/$totalCom * 100;
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
