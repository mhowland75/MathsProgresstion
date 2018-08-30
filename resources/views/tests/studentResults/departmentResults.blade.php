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
 <h1>Maths</h1>
 <div class="col-sm-10">
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
            @foreach($array as $department => $subject)
            <tr>
              <td><a href="/results/course/{{$year_id}}/dept/{{$department}}">{{$department}}</a></td>
              <td>{{$subject['maths']['unitResults']['testsPassed']}}</td>
              <td>{{$subject['maths']['unitResults']['%testsPassed']}}%</td>
              <td>{{$subject['maths']['unitResults']['testsAttempted']}}</td>
              <td>{{$subject['maths']['unitResults']['%testsAttempted']}}%</td>
              <td>{{$subject['maths']['unitResults']['testsNotAttempted']}}</td>
              <td>{{$subject['maths']['unitResults']['%testsNotAttempted']}}%</td>
              <td>{{$subject['maths']['unitResults']['totalStudents']}}</td>
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
            @foreach($array as $department => $subject)
            <tr>
              <td><a href="/results/course/{{$year_id}}/dept/{{$department}}">{{$department}}</a></td>
              <td>{{$subject['maths']['testResults']['passed']}}</td>
              <td>{{$subject['maths']['testResults']['%passed']}}%</td>
              <td>{{$subject['maths']['testResults']['attempted']}}</td>
              <td>{{$subject['maths']['testResults']['%attempted']}}%</td>
              <td>{{$subject['maths']['testResults']['notAttempted']}}</td>
              <td>{{$subject['maths']['testResults']['%notAttempted']}}%</td>
              <td>{{$subject['maths']['testResults']['totalTest']}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
  </div>


       <h1>English</h1>
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
                  @foreach($array as $department => $subject)
                  <tr>
                    <td><a href="/results/course/{{$year_id}}/dept/{{$department}}">{{$department}}</a></td>
                    <td>{{$subject['english']['unitResults']['testsPassed']}}</td>
                    <td>{{$subject['english']['unitResults']['%testsPassed']}}%</td>
                    <td>{{$subject['english']['unitResults']['testsAttempted']}}</td>
                    <td>{{$subject['english']['unitResults']['%testsAttempted']}}%</td>
                    <td>{{$subject['english']['unitResults']['testsNotAttempted']}}</td>
                    <td>{{$subject['english']['unitResults']['%testsNotAttempted']}}%</td>
                    <td>{{$subject['english']['unitResults']['totalStudents']}}</td>
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
                  @foreach($array as $department => $subject)
                  <tr>
                    <td><a href="/results/course/{{$year_id}}/dept/{{$department}}">{{$department}}</a></td>
                    <td>{{$subject['english']['testResults']['passed']}}</td>
                    <td>{{$subject['english']['testResults']['%passed']}}%</td>
                    <td>{{$subject['english']['testResults']['attempted']}}</td>
                    <td>{{$subject['english']['testResults']['%attempted']}}%</td>
                    <td>{{$subject['english']['testResults']['notAttempted']}}</td>
                    <td>{{$subject['english']['testResults']['%notAttempted']}}%</td>
                    <td>{{$subject['english']['testResults']['totalTest']}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
          </div>
        </div>
 </div>
</div>


@endsection
