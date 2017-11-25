@extends('layouts.backend')

@section('content')
<div class="panel panel-default">
  <div class="panel-body">
    <table class="table table-striped">
    <thead>
      <tr>
        <th></th>
        <th>Concept</th>
        <th>Intoduction</th>
        <th>Explanation</th>
        <th>Video</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $x)
      <tr>
        <td><img class="img-thumbnail" src='{{$x->image}}'/></td>
        <td>{{$x->name}}</td>
        <td>{!!$x->description!!}</td>
        <td>{!!$x->explanation!!}</td>
        <td>{{$x->video}}</td>
        <td><a data-toggle="tooltip" title="Manage Example" href="/examples/{{$x->id}}/manage"><i style="font-size:20px" class="ion-android-add"></i></a></td>
        <td><a data-toggle="tooltip" title="Edit" href="/education/{{$x->id}}/edit"><i style="font-size:20px" class="ion-edit"></i></a></td>
        <td><a data-toggle="tooltip" title="Remove" href="/education/{{$x->id}}/delete"><i style="font-size:20px" class="ion-android-delete"></i></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
</div>
@endsection
