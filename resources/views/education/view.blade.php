@extends('layouts.app')
@section('banner')
<div id="bannerlearning" class="jumbotron">
  <center>
    <h1>{{$data->name}}</h1>
  </center>
</div>
@endsection
@section('content')
<div>
  <a href="">Back to Education</a>
</div>
<div style="padding-top:10px;" class="row">
 <div class="col-sm-5 col-md-6">
   <img class="img-rounded" src='{{$data->image}}'/>
   <br />
   <div>
    {!!$data->description!!}
  </div>
 </div>
 <div class="col-sm-7 col-md-6">
 <div>
   {!!$data->explanation!!}
 </div>
</div>
</div>
<br />
<hr />
<br />
<div style=" background: linear-gradient(white, #fcfcfc, white);" class="row">
 <div class="col-sm-12 col-md-10 col-md-offset-1">
   <iframe id="video" src="{{$data->video}}" frameborder="0" allowfullscreen></iframe>
 </div>
</div>
<br />
<hr />
<br />
@if (!empty($examples[0]))

  <ul class="nav nav-tabs">
    <?php $x=1;?>
    @foreach ($examples as $example)
        <li  <?php if($x == 1){echo'class="active"';}?>><a id="exampleNav" data-toggle="tab" href="#{{$example->id}}">{{$example->name}}</a></li>
        <?php $x++?>
    @endforeach
  </ul>
    <div class="tab-content">
      <?php $y=1;?>
  @foreach ($examples as $example)
    <div id="{{$example->id}}" <?php if($y == 1){echo'class="tab-pane fade in active"';}else{echo'class="tab-pane fade"';}?> >
      <div class="page-header">
        <center>
          <h3>{{$example->name}}</h3>
        </center>
      </div>
      <div class="row">
       <div class="col-sm-7">
         <center>
           <h4>Queston: {{$example->question}}</h4>
         </center>
         <br />
         <p>{{$example->explanation}}</p><br />
          <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#{{$example->id}}answer">Answer</button>
          <div id="{{$example->id}}answer" class="collapse">
            <h2>The answer is {{$example->answer}}</h2>
          </div>
       </div>
       <div class="col-sm-5">
          <img class="img-rounded" src='{{$example->image}}'/>
          <p>{{$example->introduction}}</p><br />
       </div>
      </div>

    </div>
    <?php $y++?>
  @endforeach
  </div>
<br />
<hr />
<br />
@endif

<div>
  <center>
    <a href="/departments/view">
      <div id="dqImage">
        <img src='/images/dq logo.png'/>
      </div>
      </a>
    <h3>Ready to test yourself head to Diagnostic Questions.</h3>
    <br />
    <a href="/departments/view"></a><button type="button" class="btn btn-primary">Diagnostic Questions</button></a>
    <br /><br />
  </center>

</div>
</div>

@endsection
