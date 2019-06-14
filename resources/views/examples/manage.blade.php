@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div id="main-panel-head"  class="panel-heading">
    <center>
      <h1>Examples for {{$education->name}}</h1>
    </center>
  </div>
  <div id="main-panel-body" class="panel-body">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row">
         <div class="col-sm-4"><a href="/examples/{{$education->id}}/create"><button style="margin:20px; width:80%;"  type="button" class="btn btn-primary">Create New Example</button></a></div>
         <div class="col-sm-4"></div>
         <div class="col-sm-4"><center><input style="margin:20px; width:80%;" class="form-control" id="myInput" type="text" placeholder="Search.."></center></div>
        </div>
        <table class="table table-striped">
        <thead>
          <tr>
            <th></th>
            <th>Title</th>
            <th>Introduction</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Created</th>
            <th>Updated</th>
          </tr>
        </thead>
        <tbody id="myTable">
          @foreach ($data as $x)
          <tr>
            <td><img style="max-width:200px; min-width:100px" class="img-thumbnail" src='{{$x->image}}'/></td>
            <td>{{$x->name}}</td>
            <td>{!!$x->introduction!!}</td>
            <td>{{$x->question}}</td>
            <td>{{$x->answer}}</td>
            <td>{{$x->created_by}}</td>
            <td>{{$x->updated_by}}</td>
            <td><a data-toggle="tooltip" title="Visibility" href="/examples/manage/visibility/{{$x->id}}"><?php if($x->visibility == 1){echo'<i style="font-size:20px" class="ion-eye"></i>';}else{echo'<i style="font-size:20px" class="ion-eye-disabled"></i>';} ?></a></td>
            <td><a data-toggle="tooltip" title="Edit" href="/examples/{{$x->id}}/edit"><i style="font-size:20px" class="ion-edit"></i></a></td>
            <td><a data-toggle="tooltip" title="Remove" href="/examples/{{$x->id}}/delete"><i style="font-size:20px" class="ion-android-delete"></i></a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
    </div>
  </div>
</div>
@endsection
