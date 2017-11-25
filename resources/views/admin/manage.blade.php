@extends('layouts.backend')

@section('content')
<div class="page-header">
  <div class="row">
   <div class="col-sm-8">
     <h1>Administrator Management</h1>
   </div>
   <div class="col-sm-4">
   </div>
  </div>
</div>
<div class="panel panel-default">
  <div class="row">
   <div class="col-sm-4"><a href="/education/create"><button  style="margin:20px; width:80%;" type="button" class="btn btn-primary">Create New learning Aid</button></a></div>
   <div class="col-sm-4"></div>
   <div class="col-sm-4"><center><input style="margin:20px; width:80%;" class="form-control" id="myInput" type="text" placeholder="Search.."></center></div>
  </div>

  <div class="panel-body">
    <table  class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Job Title</th>
      </tr>
    </thead>
    <tbody id="myTable">
      @foreach ($data as $x)
      <tr>
        <td style="width: 5%;">{{$x->name}}</td>
        <td>{{$x->email}}</td>
          <td>{{$x->job_title}}</td>
        <td><a data-toggle="tooltip" title="Manage Example" href="/examples/{{$x->id}}/manage"><i style="font-size:20px" class="ion-ios-gear"></i></a></td>
        <td><a data-toggle="tooltip" title="Edit" href="/education/{{$x->id}}/edit"><i style="font-size:20px" class="ion-edit"></i></a></td>
        <td><a data-toggle="tooltip" title="Remove" href="/education/{{$x->id}}/delete"><i style="font-size:20px" class="ion-android-delete"></i></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
</div>
@endsection
