@extends('layouts.backend')
@section('content')
<div class="row">
 <div class="col-sm-2">
   <div class="vertical-menu">
     <a href="/results/index/{{$year_id}}" class="active"><b>Year Results</b></a>
     <a href="/results/department/{{$year_id}}"><b>Departments</b></a>
     @foreach ($nav as $department => $courses)
       <a href="/results/course/{{$year_id}}/dept/{{$department}}"><b>{{$department}}</b></a>
       @foreach ($courses as $course)
         <a href="/results/course/{{$year_id}}/course/{{$course}}">{{$course}}</a>
       @endforeach
     @endforeach
   </div>
 </div>
 <div class="col-sm-10">
   <h2>Maths</h2>
   <ul class="list-group">
     <li class="list-group-item">Students Passed<span class="badge">{{$results['maths']['unitResults']['testsPassed']}}</span><span class="badge">{{$results['maths']['unitResults']['%testsPassed']}}%</span></li>
     <li class="list-group-item">Students Attempted<span class="badge">{{$results['maths']['unitResults']['testsAttempted']}}</span><span class="badge">{{$results['maths']['unitResults']['%testsAttempted']}}%</span></li>
     <li class="list-group-item">Students Not Started <span class="badge">{{$results['maths']['unitResults']['testsNotAttempted']}}</span><span class="badge">{{$results['maths']['unitResults']['%testsNotAttempted']}}%</span></li>
     <li class="list-group-item">Total Students <span class="badge">{{$results['maths']['unitResults']['totalStudents']}}</span></li>
   </ul>
   <ul class="list-group">
     <li class="list-group-item">Tests Passed<span class="badge">{{$results['maths']['testResults']['passed']}}</span><span class="badge">{{$results['maths']['testResults']['%passed']}}%</span></li>
     <li class="list-group-item">Tests Attempted<span class="badge">{{$results['maths']['testResults']['attempted']}}</span><span class="badge">{{$results['maths']['testResults']['%attempted']}}%</span></li>
     <li class="list-group-item">Tests Not Started <span class="badge">{{$results['maths']['testResults']['notAttempted']}}</span><span class="badge">{{$results['maths']['testResults']['%notAttempted']}}%</span></li>
     <li class="list-group-item">Total Tests <span class="badge">{{$results['maths']['testResults']['totalTest']}}</span></li>
     </ul>
   <h2>English</h2>
   <ul class="list-group">
     <li class="list-group-item">Students Passed<span class="badge">{{$results['english']['unitResults']['testsPassed']}}</span><span class="badge">{{$results['english']['unitResults']['%testsPassed']}}%</span></li>
     <li class="list-group-item">Students Attempted<span class="badge">{{$results['english']['unitResults']['testsAttempted']}}</span><span class="badge">{{$results['english']['unitResults']['%testsAttempted']}}%</span></li>
     <li class="list-group-item">Students Not Started <span class="badge">{{$results['english']['unitResults']['testsNotAttempted']}}</span><span class="badge">{{$results['english']['unitResults']['%testsNotAttempted']}}%</span></li>
     <li class="list-group-item">Total Students <span class="badge">{{$results['english']['unitResults']['totalStudents']}}</span></li>
   </ul>
   <ul class="list-group">
     <li class="list-group-item">Tests Passed<span class="badge">{{$results['english']['testResults']['passed']}}</span><span class="badge">{{$results['english']['testResults']['%passed']}}%</span></li>
     <li class="list-group-item">Tests Attempted<span class="badge">{{$results['english']['testResults']['attempted']}}</span><span class="badge">{{$results['english']['testResults']['%attempted']}}%</span></li>
     <li class="list-group-item">Tests Not Started <span class="badge">{{$results['english']['testResults']['notAttempted']}}</span><span class="badge">{{$results['english']['testResults']['%notAttempted']}}%</span></li>
     <li class="list-group-item">Total Tests <span class="badge">{{$results['english']['testResults']['totalTest']}}</span></li>
     </ul>
 </div>
</div>
@endsection
