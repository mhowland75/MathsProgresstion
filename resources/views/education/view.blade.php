@extends('layouts.app')
@section('banner')
<div style="background-color:#00A1AE; width:100%; height:100%">
  <div id="bannerlearning" class="jumbotron">
    <center>
      <h1>{{$data->name}}</h1>
    </center>
  </div>
</div>
@endsection
@section('content')
<div class="panel panel-default">
  <div class="panel-body">
    <div class="row" style="padding:20px;">
     <div class="col-sm-5 col-md-6" >
       <center>
         <img style="max-height:500px; max-width:500px;" class="img-rounded" src='{{$data->image}}'/>
       </center>
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
  </div>
</div>
<br />
<div style=" background-color:none;" class="row">
 <div class="col-sm-12 col-md-10 col-md-offset-1">
   <iframe id="video1" src="{{$data->video}}" frameborder="0" allowfullscreen></iframe>
 </div>
</div>
<br />
<div class="panel panel-default">
  <div class="panel-body">
    <div style="padding:20px;">
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
            <div class="row">
             <div class="col-sm-7">
                <center>
                   <b><h3>{{$example->name}}</h3></b>
                </center>
                <br />
                <h4>Queston: {{$example->question}}</h4>
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
      @endif

    <br />
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
</div>

</div>

@endsection
