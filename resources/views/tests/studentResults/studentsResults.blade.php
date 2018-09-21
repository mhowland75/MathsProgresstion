@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div id="main-panel-head"  class="panel-heading">
    <center>
      <h1>{{$course}} Results</h1>
    </center>
  </div>
  <div id="main-panel-body" class="panel-body">
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
       @foreach($array as $title => $subject)
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3>
              {{$title}}
            </h3>
          </div>
          <div class="panel-body"><table class="table table-striped">
            <thead>
              <tr>
                <th>
                  Student
                </th>
                @foreach($subject['tests'] as $test)
                <th>
                  {{$test->name}}
                </th>
                @endforeach
                <th>
                  Total Passed
                </th>
                <th>
                  Status
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($subject['students'] as $student)
              <tr>
                <td>
                  <b>
                    {{$student->firstname}}<br />{{$student->surname}}
                  </b>
                </td>
                @foreach($student['tests'] as $test)
                  @if(!empty($test['result']->id))
                  <td>
                    @if($test['result']->correct_answers >= $test->passmark)
                     <p style="color:green; font-weight:bold">
                       {{$test['result']->correct_answers}}/{{$test->passmark}}
                     </p>
                     @else
                     <p style="color:red; font-weight:bold">
                       {{$test['result']->correct_answers}}/{{$test->passmark}}
                     </p>
                    @endif
                  </td>
                  @else
                  <td>
                    <p style="color:yellow">
                      N/A
                    </p>
                  </td>
                  @endif
                @endforeach
                <td>
                  {{$student['overallResult']['passed']}}
                </td>
                <td>
                  {{$student['overallResult']['overAll']}}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        </div>
       @endforeach
     </div>
    </div>
  </div>
</div>
@endsection
