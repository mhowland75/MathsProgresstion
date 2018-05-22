@extends('layouts.app')

@section('content')
<form class="form-horizontal" method="POST" action="/studentsResults/store">
    {{ csrf_field() }}
  @foreach($test->questions as $question)
    @if($question->visibility == 1)
      <h1>{{$question->question}}</h1>
      <br />
      @if($question->image)
       <img style="max-width:200px; min-width:100px"  class="img-thumbnail" src='{{$question->image}}'/>
      @endif
      @foreach($question->answers as $answer)
        <input type="radio" name="{{$question->id}}" value="{{$answer->id}}">{{$answer->answers}}<br>
      @endforeach
    @endif
  @endforeach
  <div class="form-group">
      <div class="col-md-6 col-md-offset-4">
          <button type="submit" class="btn btn-primary">
              Submit Test
          </button>
      </div>
  </div>
  </form>
@endsection
