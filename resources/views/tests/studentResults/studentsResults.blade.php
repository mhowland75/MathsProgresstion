@extends('layouts.backend')
@section('content')
<center>
  <h1>{{$course}} Results</h1>
</center>
<br />
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
   <div class="panel panel-default">
      <div class="panel-heading"><h3>Maths</h3></div>
      <div class="panel-body">
        <table class="table table-striped">
            <thead>
              <tr>
                <th>Student</th>
                @foreach($students['maths']['tests'] as $test)
                  <th>
                    {{$test->name}}<br />
                    Pass Mark: {{$test->passmark}}
                  </th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach($students['maths']['students'] as $student)
              <tr>
                <td>
                  <b>{{$student->student_id}}<br />{{$student->firstname}}{{$student->surname}}</b>
                </td>
                @foreach($student->tests as $test)
                  @if(!empty($test->result->id))
                    @if($test->result->correct_answers >= $test->passmark)
                    <td>
                      <p style="color:green">
                        {{$test->result->correct_answers}}/{{$test->result->total_questions}}
                      </p>
                    </td>
                    @else
                    <td>
                      <p style="color:yellow">
                        {{$test->result->correct_answers}}/{{$test->result->total_questions}}
                      </p>
                    </td>
                    @endif
                  @else
                  <td>
                    <p style="color:red">
                      N/A
                    </p>
                  </td>
                  @endif
                @endforeach
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>

     <div class="panel panel-default">
      <div class="panel-heading"><h3>Maths - Overall</h3></div>
      <div class="panel-body">
        <table class="table table-striped">
            <thead>
              <tr>
                <th>Student</th>
                  <th>
                    Student Status
                  </th>
                  <th>
                    Passed
                  </th>
                  <th>
                    Attempted
                  </th>
                  <th>
                    Not Started
                  </th>
              </tr>
            </thead>
            <tbody>
              @foreach($students['maths']['students'] as $student)
              <td>
                <b>{{$student->student_id}}<br />{{$student->firstname}}{{$student->surname}}</b>
              </td>
              <td>
                @if($student['overallResult']['overAll'] == 'Pass')
                  <p style="color:green">
                    <b>{{$student['overallResult']['overAll']}}</b>
                  </p>
                @elseif($student['overallResult']['overAll'] == 'Started')
                <p style="color:yellow">
                  <b>{{$student['overallResult']['overAll']}}</b>
                </p>
                @elseif($student['overallResult']['overAll'] == 'Not Started')
                <p style="color:red">
                  <b>{{$student['overallResult']['overAll']}}</b>
                </p>
                @endif
              </td>
              <td>
                {{$student['overallResult']['passed']}}
              </td>
              <td>
                {{$student['overallResult']['attempted']}}
              </td>
              <td>
                {{$student['overallResult']['notAttempted']}}
              </td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>


   <div class="panel panel-default">
      <div class="panel-heading"><h3>English</h3></div>
      <div class="panel-body">
        <table class="table table-striped">
            <thead>
              <tr>
                <th>Student</th>
                @foreach($students['english']['tests'] as $test)
                  <th>
                    {{$test->name}}<br />
                    Pass Mark: {{$test->passmark}}
                  </th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach($students['english']['students'] as $student)
              <tr>
                <td>
                  <b>{{$student->student_id}}<br />{{$student->firstname}}{{$student->surname}}</b>
                </td>
                @foreach($student->tests as $test)
                  @if(!empty($test->result->id))
                  @if($test->result->correct_answers >= $test->passmark)
                  <td>
                    <p style="color:green">
                      {{$test->result->correct_answers}}/{{$test->result->total_questions}}
                    </p>
                  </td>
                  @else
                  <td>
                    <p style="color:yellow">
                      {{$test->result->correct_answers}}/{{$test->result->total_questions}}
                    </p>
                  </td>
                  @endif
                  @else
                  <td>
                    <p style="color:red">
                      N/A
                    </p>
                  </td>
                  @endif
                @endforeach
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
     <div class="panel panel-default">
        <div class="panel-heading"><h3>English - Overall</h3></div>
        <div class="panel-body">
          <table class="table table-striped">
              <thead>
                <tr>
                  <th>Student</th>
                    <th>
                      Student Status
                    </th>
                    <th>
                      Passed
                    </th>
                    <th>
                      Attempted
                    </th>
                    <th>
                      Not Started
                    </th>
                </tr>
              </thead>
              <tbody>
                @foreach($students['english']['students'] as $student)
                <td>
                  <b>{{$student->student_id}}<br />{{$student->firstname}}{{$student->surname}}</b>
                </td>
                <td>
                  @if($student['overallResult']['overAll'] == 'Passed')
                    <p style="color:green">
                      <b>{{$student['overallResult']['overAll']}}</b>
                    </p>
                  @elseif($student['overallResult']['overAll'] == 'Started')
                  <p style="color:yellow">
                    <b>{{$student['overallResult']['overAll']}}</b>
                  </p>
                  @elseif($student['overallResult']['overAll'] == 'Not Started')
                  <p style="color:red">
                    <b>{{$student['overallResult']['overAll']}}</b>
                  </p>
                  @endif

                </td>
                <td>
                  {{$student['overallResult']['passed']}}
                </td>
                <td>
                  {{$student['overallResult']['attempted']}}
                </td>
                <td>
                  {{$student['overallResult']['notAttempted']}}
                </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
      </div>

 </div>
</div>


@endsection
