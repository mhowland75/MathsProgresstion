@extends('layouts.app')
@section('banner')
<div id="bannerEducation" class="jumbotron">
  <center>
    <h1>Learning Resource</h1>
    <p>Please choose a subject you wish to study.</p>
  </center>
</div>
@endsection
@section('content')
<div  class="row">
  @foreach ($data as $x)
  <a id="linksHeadings" href="/education/view/{{$x->id}}">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div id="educationIndexPanel" class="panel panel-default">
            <div id="wrapper" class="panel-body">
              <div id="hover">
              </div>
              <div>
                <img src='{{$x->image}}'/>
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
@endsection
