@extends('layouts.backend')

@section('content')
<div class="row">
 <div class="col-sm-8">
   <div class="page-header">
     <center>
       <h1>Courses for {{$dept}}</h1>
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
      <th>Courses</th>
      <th>Percentage Passed</th>
      <th>Compleate</th>
      <th>Incompleate</th>
    </tr>
  </thead>
  <tbody id="myTable">
    @foreach ($data as $x=>$y)
    <tr>
      <td><a href="/results/{{$x}}/student">{{$x}}</a></td>
      <td>{{$y['percentPass']}}%</td>
      <td>{{$y['studentsComplete']}}%</td>
      <td>{{$y['studentsIncomplete']}}%</td>
    @endforeach
  </tbody>
</table>
</div>

@endsection
