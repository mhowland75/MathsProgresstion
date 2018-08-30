@extends('layouts.app')
@section('content')
@section('banner')
  <div id="titleBanner">
    <center>
      <h1>{{$test->name}}</h1>
    </center>
  </div>
@endsection
<form class="form-horizontal" method="POST" action="/studentsResults/store">
    {{ csrf_field() }}
    <?php $x=0 ?>
  @foreach($test->questions as $question)
  <?php $x++ ?>
  <div class="panel panel-default">
    <div style="background-color:  #f2f3f4" class="panel-heading"><h2>{{$question->question}}</h2></div>
    <div style="background-color: #f4f6f6" class="panel-body">
      @if($question->visibility == 1)
      <div class="row">
        <div class="col-sm-1">
          <h2 style="padding:50%; font-size:40px;">{{$x}}.</h2>
        </div>
        @if($question->image)
         <div class="col-sm-3">
            <img style="max-width:250px; min-width:100px"  class="img-thumbnail" src='{{$question->image}}'/>
         </div>
         @else
         <div class="col-sm-1">
         </div>
       @endif
       <div class="col-sm-8">
         <ul class="list-group">
           <?php $y = 0;?>
         @foreach($question->answers as $answer)
          <?php $y++; ?>
         <li class="list-group-item">
           <div onclick="getElementById('{{$x}}{{$y}}').checked=true" class="row">
             <div style="padding-top:10px" class="col-sm-1" >
               <input id="{{$x}}{{$y}}" type="radio" name="{{$question->id}}" value="{{$answer->id}}"></div>
             <div class="col-sm-11"><h4 onclick="getElementById('{{$x}}{{$y}}').checked=true">{{$answer->answers}}</h4></div>
            </div>
          </li>
         @endforeach
         </ul>
       </div>
      </div>
      @endif
    </div>
  </div>
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
