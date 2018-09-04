@extends('layouts.app')
@section('banner')
  <div id="titleBanner">
    <center>
      <h1>Results</h1>
    </center>
  </div>
@endsection
@section('content')
<div class="row">
 <div class="col-sm-12">
   @foreach($array as $key => $subject)
   <div class="panel panel-default">
    <div class="panel-heading">
      {{$key}}
    </div>
    <div class="panel-body">
      <table class="table table-striped">
      <thead>
        <tr>
          @foreach($subject['tests'] as $test)
          <th>
            {{$test->name}}
          </th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @foreach($subject['students'] as $student)
        <tr>
          @foreach($student['tests'] as $test)
            @if(!empty($test['result']->id))
            <td>
              {{$test['result']->correct_answers}}/{{$test->passmark}}
            </td>
            @else
            <td>
              N/A
            </td>
            @endif
          @endforeach
        </tr>
        @endforeach
      </tbody>
      </table>
    </div>
  </div>
   @endforeach
 </div>
</div>
@endsection
