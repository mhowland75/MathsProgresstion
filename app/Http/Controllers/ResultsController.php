<?php

namespace App\Http\Controllers;
use App\Results;
use App\Student;
use Illuminate\Http\Request;
use DB;

class ResultsController extends Controller
{

    private $passMark = 30;


    public function create(){
      return view('results.create');
    }
    public function index(){
      //return $this->findId();
      $data = Results::paginate(100);
      return view('results.index',compact('data'));
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
    public function departmentStats(){
      //gets list of all departments
      $data = Student::select('dept')->get();
      //return $data[0]->dept;
      $dept = array();
      $departments =array();
      foreach($data as $x){
          $dept[] = $x->dept;
          foreach($dept as $y){
            //sorts list into individual instances in the list
            if (!in_array($y, $departments))
              {
                $departments[] = $y;
              }
          }
      }
          $percentage = array();
        foreach($departments as $q){
          //finds all the students in the department
           $student = Student::select('student_id')->where('dept',$q)->get();
           $studentid = array();
           //cleans up the array. list of student id for the department
           foreach($student as $g){
             $studentid[] = $g->student_id;
           }
           $results = array();
           $d = array();
           //gets the results for each student in the department
           foreach($studentid as $u){
              $result = Results::select('results')->where('student_id',$u)->where('completed', 'Yes')->get();
              //return $result;
              if(!$result->isEmpty()){
                $results[] = $result;
              }
              $d[] = Results::select('results')->where('student_id',$u)->get();
           }

           $compleate = count($results)/count($d) * 100;

          //  $results = Results::select('results')->get();
           $resultsClean = array();
           foreach($results as $w=>$x){
             if(!empty($x[0]->results)){
               $result = $x[0]->results;
               $resultsClean[] = $this->cleanResult($result);
             }
           }
          // return $results;
           $passed = array();
           foreach($resultsClean as $t){
             if($t['score'] >= $this->passMark){
               $passed[] = $t;
             }
           }
           $passed = count($passed);
           $totalStudents = count($resultsClean);
           if(!$totalStudents == 0){
             $present = $passed/$totalStudents * 100;
           }
           else {
             $present = 0;
           }


           $incompleate = 100 - $compleate;
          $percentage[] = array('dept'=>$q,'pass'=>round($present,2),'compleate'=>round($compleate,2), 'incompleate'=>round($incompleate,2));

       }

      return $percentage;
    }
    public function deptView(){
      $array = $this->overallStats();
      $data = $this->departmentStats();
      return view('results.stats.department',compact('data','array'));

    }
    public function overallStats(){
      $data = Results::select('results')->where('completed','Yes')->get();
      //return $data;
      foreach($data as $rt){
        $rt['results'] = $this->cleanResult($rt['results']);
      }
      $i = 0;
      $w = 0;
      foreach($data as $rt){
        if($rt->results['score'] >= $this->passMark){
          $i++;
        }
        $w++;
      }
      $percentagePass = $i/$w *100;
      $results = Results::select('completed')->get();
      $q = 0;
      $e = 0;
      foreach($results as $result){
        if($result->completed == "Yes"){
          $q++;
        }
        $e++;
      }
      $percentageCom = $q/$e * 100;
      $toCom = $e - $q;
      $totalStudents = Results::count();
      return array('passed'=>$i,'total'=>$w,'percentagePass'=>round($percentagePass,2),'percentageCom'=>round($percentageCom,2),'TotalCom'=>$q, 'toCom'=>$toCom, 'TotalResults'=>  $totalStudents);
      //return view('results.stats.overall',compact('array'));

    }
    public function courseStats($dept){
      $data = Student::select('course')->where('dept',$dept)->get();
      $courses = array();
      foreach($data as $x){
        if(!in_array($x['course'],$courses)){
          $courses[] = $x['course'];
        }
      }
      $studentid= array();
      $w = array();
      foreach($courses as $course){
         $studentid[$course] = Student::select('student_id')->where('course',$course)->get();
      }
      $array = array();
      foreach ($studentid as $y){
        $courseResults = array();
        foreach($y as $q){
          $result = Results::select('results')->where('student_id',$q->student_id)->where('completed','Yes')->get();
          if(!$result->isEmpty()){
            if(empty($f)){
                $f = Student::select('course')->where('student_id',$q->student_id)->get();
            }
           $result = $this->cleanResult($result[0]->results);
           $courseResults[] = $result['score'];
          }
        }
        $array[$f[0]->course] = $courseResults;
        $f = '';
      }
      $scores=array();
      foreach($array as $t=>$r){
        $i=0;
        $x=0;
        foreach($r as $s){
          if($s >= $this->passMark){
            $i++;
          }
          $x++;
        }
         $passedFailed = array('passed'=>$i,'total'=>$x);
         $scores[$t] = $passedFailed;
      }

      foreach($scores as $o=>$score){
        $scores[$o]['percentPass'] = round($score['passed']/$score['total'] *100);

      }
      $cou= array();
      foreach($scores as $e=>$d){
        $cou[] = $e;
      }
      $bob = array();
      foreach($cou as $rt){
         $students = Student::select('student_id')->where('course',$rt)->get();
         $bob[$rt] = $students;

      }
      $wer = array();
      foreach($bob as $yu=>$cm){
        $cde = array();
        foreach($cm as $er){
           $com = Results::select('completed')->where('student_id',$er->student_id)->get();
           $cde[] = $com;
        }
        $wer[$yu] = $cde;
      }

      //return $wer;
      foreach($wer as $qw=>$ny){
        $ok = 0;
        $fg = 0;
        foreach($ny as $ft){
          if($ft[0]->completed == "Yes"){
            $ok++;
          }
          $fg++;
        }
        $redf = $ok/$fg * 100;
        $incompleate = 100 - $redf;
        $scores[$qw]['studentsComplete'] = round($redf,2);
        $scores[$qw]['studentsIncomplete'] = round($incompleate,2);
      }
      return $scores;
    }
    public function courseView($dept){
      $data = $this->courseStats($dept);
      return view('results.stats.course',compact('data','dept'));
    }
    public function studentView($course){
      $data = Student::select('student_id')->where('course',$course)->get();
      $f = array();
      foreach($data as $t){
        $f[] = Results::where('student_id',$t->student_id)->get();
      }
      //return $f;
      foreach($f as $d){
        $r = $this->cleanResult($d[0]->results);
        $d[0]->results = $r['score'].' / '.$r['outOf'];
      }

      return view('results.stats.student',compact('f','course'));
    }
    public static function cleanResult($result){
      $result = trim($result,"'/ /");
      $score = substr($result,0,2);
      $outOf = substr($result,3,2);
      return array('score'=> $score, 'outOf'=>$outOf);
    }
}
