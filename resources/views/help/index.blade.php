@extends('layouts.backend')

@section('content')
<div class="panel panel-default">
  <div class="panel-body">
    <table class="table table-striped">
    <thead>
      <tr>

        <th>Student</th>
        <th>Email</th>
        <th>Subject</th>
        <th>Message</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $x)
      <tr>
        <td>{{$x->name}}</td>
        <td>{{$x->email}}</td>
        <td>{{$x->subject}}</td>
        <td>{!!$x->message!!}</td>
        <td><a data-toggle="tooltip" title="Manage Example" href="/examples/{{$x->id}}/manage"><i style="font-size:20px" class="ion-android-add"></i></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
</div>
@endsection
