@extends('layouts.app')
@section('banner')
<div id="bannerEducation" class="jumbotron">
  <center>
    <h1>{{$subject}}</h1>
  </center>
</div>
@endsection
@section('content')
<div id="educationIndexBoxesContainer">
  <div  class="row">
    @foreach ($data as $x)
    <a id="linksHeadings" href="/education/view/{{$x->id}}">
          <div class="col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-0 ">
            <div id="educationIndexPanel" class="panel panel-default">
              <div style="max-height:200px;" id="wrapper" class="panel-body">
                <div id="hover">
                </div>
                <div id="imageDiv">
                  <center>
                    <img style="max-height:170px; max-width:300px;" src='{{$x->image}}'/>
                  </center>
                </div>
              </div>
              <div style="background-color:#0093A8" class="panel-footer"><center>
                <h4>
                  {{$x->name}}
                </h4>
              </center></div>
            </div>
          </div>
          </a>
    @endforeach
  </div>
</div>

@endsection
