@extends('layouts.backend')

@section('content')
<div class="page-header">
  <h1>Overall Stats</h1>
</div>
<div class="row">
  <div class="col-sm-2">
    <div class="vertical-menu">
     <a href="/results/overallStats"><b>Overall Stats</b></a>
     <a href="/results/departments"><b>Departments</b></a>
     @foreach ($nav as $x=>$y)
      <a href="/results/{{$x}}/course"><b>{{$x}}</b></a>
        @foreach ($y as $p)
         <a href="/results/{{$p}}/student"><p style='font-size: 90%;'>{{$p}}</p></a>
        @endforeach
     @endforeach
    </div>
  </div>
  <div class="col-sm-1">
  </div>
 <div class="col-sm-4">
   <h2>Passed</h2>
   <ul class="list-group">
     <li class="list-group-item">Passed Students<span class="badge">{{$array['passedStudents']}}</span></li>
     <li class="list-group-item">% Passed Students<span class="badge">{{$array['perPassedStudents']}}%</span></li>
     <li class="list-group-item">% Quizzes Passed<span class="badge">{{$array['perPassedQuizes']}}%</span></li>
     <li class="list-group-item">Passed Quizzes <span class="badge">{{$array['passedQuizes']}}</span></li>
   </ul>

 <h2>Compleated</h2>
 <ul class="list-group">

   <li class="list-group-item">Completed Students <span class="badge">{{$array['comTests']}}</span></li>
   <li class="list-group-item">% Completed Students <span class="badge">{{$array['perComTests']}}%</span></li>
   <li class="list-group-item">% Completed Quizzes <span class="badge">{{$array['perQuizesCom']}}%</span></li>
   <li class="list-group-item">Incompleted Quizzes <span class="badge">{{$array['attmptedButIncomQuizes']}}</span></li>
   <li class="list-group-item">Completed Quizzes <span class="badge">{{$array['comQuizes']}}</span></li>
 </ul>

 <h2>Attempted</h2>
 <ul class="list-group">
   <li class="list-group-item">Attempted Students <span class="badge">{{$array['attemptedTests']}}</span></li>
   <li class="list-group-item">% Attempted Students <span class="badge">{{$array['perAttemptedTests']}}%</span></li>
   <li class="list-group-item">% Attempted Quizzes <span class="badge">{{$array['perQuizesAttempted']}}%</span></li>
   <li class="list-group-item">Attempted Quizzes <span class="badge">{{$array['attemptedQuizes']}}</span></li>
   <li class="list-group-item">Quizzes Not Attempted<span class="badge">{{$array['quizesLeft']}}</span></li>

 </ul>
 <h2>Totals</h2>
 <ul class="list-group">
   <li class="list-group-item">Total Students <span class="badge">{{$array['totalStudents']}}</span></li>
   <li class="list-group-item">Total Quizzes <span class="badge">{{$array['totalQuizes']}}</span></li>
   <li class="list-group-item">Pass Mark <span class="badge">{{$passMark}}</span></li>
 </ul>
  </div>
 <div class="col-sm-5">
   <h2>Results Key</h2>
   <div class="panel panel-default">
     <div class="panel-body">
       <b>Quizzes</b><p>
         Students have nine separate Quizzes which make up the overall test. For example Pythagoras is one of the nine quizzes the students will have to do.
       </p>
       <br />
       <b>Students/Tests</b><p>
         A student will take nine quizzes which make up the test. One student takes one test and can therefore be thought of interchangeably.
       </p>
       <br />
       <b>Passed</b><p>
          Refers to completed quizzes which have exceeded the pass mark and to pass a test all the nine quizzes of a student has to exceed the pass mark.
       </p>
       <br />

       <b>Completed</b><p>
         Is all completed quizzes or tests regardless of the pass mark.
       </p>
       <br />
       <b>Attempted</b><p>
          Is both complete and incomplete quizzes or tests but they have been started.
       </p>
       <br />
       <b>Not Attempted</b><p>
        A  student has made no attempt at a quiz or test yet and therefore data does not appear in dataset.
       </p>
       <br />
       <b>Incomplete</b><p>
         A student has started a quiz or test but has not yet completed it.
       </p>

       <br />
     </div>
   </div>
 </div>
</div>

@endsection
