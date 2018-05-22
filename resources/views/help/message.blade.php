@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-4">
        <ul class="list-group">
          <li class="list-group-item">Name: {{$data[0]['name']}}</li>
          <li class="list-group-item">Email: {{$data[0]['email']}}</li>
          <li class="list-group-item">Subject: {{$data[0]['subject']}}</li>
          <li class="list-group-item">Sent: {{$data[0]['created_at']}}</li>
        </ul>
      </div>
      <div class="col-sm-4"></div>
      <div class="col-sm-4"></div>
    </div>
    <div class="panel panel-default">
      <div class="panel-body">
        {{$data[0]['message']}}
      </div>
    </div>

  </div>
</div>


@endsection
