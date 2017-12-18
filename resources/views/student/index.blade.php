@extends('layouts.backend')

@section('content')
<div class="row">
 <div class="col-sm-8">
   <div class="page-header">
     <center>
       <h1>Raw Student Data</h1>
     </center>
   </div>
 </div>
 <div class="col-sm-4">
   <input style="margin-top:30px" class="form-control" id="myInput" type="text" placeholder="Search..">
 </div>
</div>
<div class="panel-body">
  <table class="table table-striped">
  <thead>
    <tr>
      <th>Student ID</th>
      <th>Firstname</th>
      <th>Surname</th>
      <th>DOB</th>
      <th>Department</th>
      <th>Course</th>
      <th>GCSE Maths Grade</th>
      <th>Primary tutor</th>
      <th>Withdrwan</th>
    </tr>
  </thead>
  <tbody id="myTable">
    @foreach ($data as $x)
    <tr>
        <td>{{$x->student_id}}</td>
      <td>{{$x->firstname}}</td>
      <td>{{$x->surname}}</td>
      <td>{{$x->dob}}</td>
      <td>{{$x->dept}}</td>
      <td>{{$x->course}}</td>
      <td>{{$x->gcse_maths_grade}}</td>
      <td>{{$x->primary_tutor}}</td>
      <td>{{$x->withdrawn}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $data->links() }}
</div>


@endsection
