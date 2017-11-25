@extends('layouts.backend')

@section('content')
<div class="page-header">
     <h1>Examples for {{$education->name}}</h1>
</div>
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
        <th>Intoduction</th>
        <th>Explanation</th>
        <th>Queston</th>
        <th>Answer</th>
        <th>Created body</th>
        <th>Updated By</th>

      </tr>
    </thead>
    <tbody id="myTable">
      @foreach ($data as $x)
      <tr>
        <td><img class="img-thumbnail" src='{{$x->image}}'/></td>
        <td>{{$x->name}}</td>
        <td>{!!$x->introduction!!}</td>
        <td>{!!$x->explanation!!}</td>
        <td>{{$x->question}}</td>
        <td>{{$x->answer}}</td>
        <td>{{$x->created_by}}</td>
        <td>{{$x->updated_by}}</td>
        <td><a data-toggle="tooltip" title="Edit" href="/examples/{{$x->id}}/edit"><i style="font-size:20px" class="ion-edit"></i></a></td>
        <td><a data-toggle="tooltip" title="Remove" href="/examples/{{$x->id}}/delete"><i style="font-size:20px" class="ion-android-delete"></i></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
</div>
@endsection
