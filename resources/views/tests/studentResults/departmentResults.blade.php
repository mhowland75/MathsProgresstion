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
 @foreach($array as $subject => $departments)
 <h1>{{$subject}}</h1>
   <div class="panel panel-default">
    <div class="panel-heading"><h2>Student Stats</h2></div>
    <div class="panel-body">
      <table class="table table-striped">
          <thead>
            <tr>
              <th>Department</th>
              <th>Students Passed</th>
              <th>Students Passed %</th>
              <th>Students Started</th>
              <th>Students Started %</th>
              <th>Students Not Started</th>
              <th>Students Not Started %</th>
              <th>Total Students in Department</th>
            </tr>
          </thead>
          <tbody>
            @foreach($departments as $key => $department)
            <tr>
              <td><a href="/results/course/{{$year_id}}/dept/{{$key}}">{{$key}}</a></td>
              <td>{{$department['unitResults']['testsPassed']}}</td>
              <td>{{$department['unitResults']['%testsPassed']}}%</td>
              <td>{{$department['unitResults']['testsAttempted']}}</td>
              <td>{{$department['unitResults']['%testsAttempted']}}%</td>
              <td>{{$department['unitResults']['testsNotAttempted']}}</td>
              <td>{{$department['unitResults']['%testsNotAttempted']}}%</td>
              <td>{{$department['unitResults']['totalStudents']}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading"><h2>Tests Stats</h2></div>
    <div class="panel-body">
      <table class="table table-striped">
          <thead>
            <tr>
              <th>Department</th>
              <th>Tests Passed</th>
              <th>Tests Passed %</th>
              <th>Tests Started</th>
              <th>Tests Started %</th>
              <th>Tests Not Started</th>
              <th>Tests Not Started %</th>
              <th>Total Tests in Department</th>
            </tr>
          </thead>
          <tbody>
            @foreach($departments as $key => $department)
            <tr>
              <td><a href="/results/course/{{$year_id}}/dept/{{$key}}">{{$key}}</a></td>
              <td>{{$department['testResults']['passed']}}</td>
              <td>{{$department['testResults']['%passed']}}%</td>
              <td>{{$department['testResults']['attempted']}}</td>
              <td>{{$department['testResults']['%attempted']}}%</td>
              <td>{{$department['testResults']['notAttempted']}}</td>
              <td>{{$department['testResults']['%notAttempted']}}%</td>
              <td>{{$department['testResults']['totalTest']}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
  </div>
@endforeach
 </div>
</div>
@endsection
