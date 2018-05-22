@extends('layouts.backend')
@section('content')
<div class="row">
  <div class="col-sm-6 col-sm-offset-3">
    <div class="panel panel-default">
      <div class="panel-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Rank</th>
              <th>Name</th>
              <th>Views</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $lesson)
              <tr>
                <td>{{$lesson->rank}}</td>
                <td>{{$lesson->name}}</td>
                <td>{{$lesson->views}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>



@endsection
