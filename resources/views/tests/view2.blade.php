@extends('layouts.app')
@section('content')
@section('banner')
  <div id="titleBanner">
    <center>
      <h1>{{$test->name}}</h1>
    </center>
  </div>
@endsection
@if($errors->any())
    <div class="alert alert-warning">
      <strong>You have not answered the following questions</strong>
        @foreach($errors as $error)
          {!! $error !!}
         @endforeach
    </div>
@endif
<form class="form-horizontal" method="POST" action="/studentsResults/store">
    {{ csrf_field() }}
    <input type="hidden" name="test_id" value="{{$test->id}}">
    <input type="hidden" name="question_id" value="{{$question->id}}">
    <div class="panel panel-default">
      <div class="panel-heading">{{$question->question}}</div>
      <div class="panel-body">
        <ul class="list-group">
          @foreach($question->answers as $answer)
            <li class="list-group-item">
              <input type="radio" name="answer_id" value="{{$answer->id}}">
              {{$answer->answers}}
            </li>
          @endforeach
        </ul>
      </div>
    </div>
   
  <div class="form-group">
      <div>
          <button style="float:right" type="submit" class="btn-lg btn-primary">
              Submit Test
          </button>
      </div>
  </div>
  </form>
@endsection
