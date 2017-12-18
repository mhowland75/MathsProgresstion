@extends('layouts.backend')

@section('content')
<div class="row">
 <div class="col-sm-8">
   <div class="page-header">
     <center>
       <h1>Raw Results Data</h1>
     </center>
   </div>
 </div>
 <div class="col-sm-4">
   <input style="margin-top:30px" class="form-control" id="myInput" type="text" placeholder="Search..">
 </div>
</div>
  <table class="table table-striped">
  <thead>
    <tr>
      <th>Student ID</th>
      <th>Student Name</th>
      <th>Compleated</th>
      <th>results</th>
      <th>Start date</th>
      <th>date Compleated</th>
      <th>date due</th>
      <th>Quiz Name</th>

    </tr>
  </thead>
  <tbody id="myTable">
    @foreach ($data as $x)
    <tr>
      <td>{{$x->student_id}}</td>
      <td>{{$x->student_name}}</td>
      <td>{{$x->completed}}</td>
      <td>{{$x->results}}</td>
      <td>{{$x->start_date}}</td>
      <td>{{$x->date_started}}</td>
      <td>{{$x->date_due}}</td>
      <td>{{$x->quiz_name}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $data->links() }}
</div>


@endsection
