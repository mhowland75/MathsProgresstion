@extends('layouts.app')
@section('banner')
  <div id="titleBanner">
    <center>
      <h1>{{$subject}} Tests</h1>
    </center>
  </div>
@endsection
@section('content')
<div class="row">
 <div class="col-sm-3">
   <div class="panel panel-default">
    <div class="panel-body">
      Total Tests<span style="float:right" class="badge">
    </div>
  </div>
 </div>
 <div class="col-sm-3">
   <div class="panel panel-default">
    <div class="panel-body">
      Passed <span style="float:right" class="badge"></span>
    </div>
  </div>
 </div>
 <div class="col-sm-3">
   <div class="panel panel-default">
    <div class="panel-body">
      Attempted <span style="float:right" class="badge"></span>
    </div>
  </div>
 </div>
 <div class="col-sm-3">
   <div class="panel panel-default">
    <div class="panel-body">
      Not Attempted <span style="float:right" class="badge"></span>
    </div>
  </div>
 </div>
</div>
  <div class="row">
    @foreach($tests as $test)
      <a id="testboxtext" href="/test/{{$test->id}}/view">
        <div class="col-sm-4">
          <div style="padding:10px;">
            <div class="row">
              <div class="col-sm-12" style="background-color:#f4f6f6; border-radius:5px 5px 0px 0px; padding:20px; padding-top:50px; padding-bottom:50px">
                <center>
                  <h1 style="font-size:45px">{{$test->name}}</h1>
                  @if(!empty($results[$test->id]->correct_answers))
                    <a href="/studentsResults/view/{{$test->id}}"><button type="button" class="btn btn-success">Results</button></a>
                  @else
                    <br /><br />
                  @endif
                </center>
              </div>
            </div>
            <div class="row">
              @if(!empty($results[$test->id]->correct_answers))
                @if($results[$test->id]->correct_answers >= $test->passmark)
                  <center>
                    <div class="col-sm-4" style="background-color: #abebc6 ; border-radius:0px 0px 0px 5px ; padding:10px;"><b>Status</b><br /> Passed</div>
                  </center>
                @else
                  <center>
                    <div class="col-sm-4" style="background-color: #f9e79f ; border-radius:0px 0px 0px 5px ; padding:10px;"><b>Status</b><br /> Attempted</div>
                  </center>
                @endif
              @else
                <center>
                  <div class="col-sm-4" style="background-color: #f5b7b1 ; border-radius:0px 0px 0px 5px ; padding:10px;"><b>Status</b><br /> Not Attempted</div>
                </center>
              @endif

              <div class="col-sm-4" style="background-color: #fad7a0 ;  padding:10px;">
                <center>
                  <b>Passmark</b> <br />{{$test->passmark}}
                </center>
              </div>
              <div class="col-sm-4" style="background-color: #a9cce3 ; border-radius:0px 0px 5px 0px; padding:10px;">
                <center>
                  <b>Questions</b> <br /> {{$test->questions->count()}}
                </center>
              </div>
            </div>
          </div>
        </div>
      </a>
    @endforeach
  </div>
@endsection
