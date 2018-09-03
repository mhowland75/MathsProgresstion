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
 @foreach($subjects as $subject =>$c)

   <h2>{{$c->subject}}</h2>
   @if(!empty($results[$c->subject]['testResults']['totalTest']))
   <ul class="list-group">
     <li class="list-group-item">Students Passed<span class="badge">{{$results[$c->subject]['unitResults']['testsPassed']}}</span><span class="badge">{{$results[$c->subject]['unitResults']['%testsPassed']}}%</span></li>
     <li class="list-group-item">Students Attempted<span class="badge">{{$results[$c->subject]['unitResults']['testsAttempted']}}</span><span class="badge">{{$results[$c->subject]['unitResults']['%testsAttempted']}}%</span></li>
     <li class="list-group-item">Students Not Started <span class="badge">{{$results[$c->subject]['unitResults']['testsNotAttempted']}}</span><span class="badge">{{$results[$c->subject]['unitResults']['%testsNotAttempted']}}%</span></li>
     <li class="list-group-item">Total Students <span class="badge">{{$results[$c->subject]['unitResults']['totalStudents']}}</span></li>
   </ul>
   <ul class="list-group">
     <li class="list-group-item">Tests Passed<span class="badge">{{$results[$c->subject]['testResults']['passed']}}</span><span class="badge">{{$results[$c->subject]['testResults']['%passed']}}%</span></li>
     <li class="list-group-item">Tests Attempted<span class="badge">{{$results[$c->subject]['testResults']['attempted']}}</span><span class="badge">{{$results[$c->subject]['testResults']['%attempted']}}%</span></li>
     <li class="list-group-item">Tests Not Started <span class="badge">{{$results[$c->subject]['testResults']['notAttempted']}}</span><span class="badge">{{$results[$c->subject]['testResults']['%notAttempted']}}%</span></li>
     <li class="list-group-item">Total Tests <span class="badge">{{$results[$c->subject]['testResults']['totalTest']}}</span></li>
    </ul>
    @else
      There are no tests for this subject.
    @endif

 @endforeach
  </div>
</div>
@endsection
