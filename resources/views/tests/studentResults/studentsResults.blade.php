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
   @foreach($array as $subject)
   <table class="table table-striped">
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
     </tr>
   </thead>
   <tbody>
     @foreach($subject['students'] as $student)
     <tr>
       <td>
         {{$student->firstname}}<br />{{$student->surname}}
       </td>
       @foreach($student['tests'] as $test)
         @if(!empty($test['result']->id))
         <td>
           {{$test['result']->correct_answers}}/{{$test->passmark}}
         </td>
         @else
         <td>
           N/A
         </td>
         @endif
       @endforeach
     </tr>
     @endforeach
   </tbody>
   </table>

   @endforeach



 </div>
</div>
@endsection
