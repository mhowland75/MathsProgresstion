@extends('layouts.backend')

@section('content')
<div class="row">
 <div class="col-sm-8">
   <div class="page-header">
     <center>
       <h1>{{$course}} Class</h1>
     </center>
   </div>
 </div>
 <div class="col-sm-4">
   <input style="margin-top:30px" class="form-control" id="myInput" type="text" placeholder="Search..">
 </div>
</div>
<a href="/results/{{$dept}}/course">Back to {{$dept}}</a>
<div class="panel-body">
  <div class="panel panel-default">
  <div class="panel-body">
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Student ID</th>
        <th>Student Name</th>
        <th>Compleated</th>
        <th>Results</th>
        <th>Start Date</th>
        <th>Date Started</th>
        <th>Date Compleated</th>
        <th>Due Date</th>
        <th>Quiz Name</th>
      </tr>
    </thead>
    <tbody id="myTable">
      @foreach ($f as $x)
      <tr>
        <td>{{$x[0]->student_id}}</td>
        <td>{{$x[0]->student_name}}</td>
        <td>{{$x[0]->completed}}</td>
        <td>{{$x[0]->results}}</td>
        <td>{{$x[0]->start_date}}</td>
        <td>{{$x[0]->date_started}}</td>
        <td>{{$x[0]->date_completed}}</td>
        <td>{{$x[0]->date_due}}</td>
        <td>{{$x[0]->quiz_name}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
</div>
</div>
@endsection
