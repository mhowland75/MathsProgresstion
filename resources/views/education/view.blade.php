@extends('layouts.app')
@section('banner')
  <div id="titleBanner">
    <center>
      <h1>{{$data->name}}</h1>
    </center>
  </div>
@endsection
@section('content')
<div class="row" style="padding:0px;">
 <div class="col-sm-5 col-md-6" style="margin-bottom:30px">
   <center>
     <img style="max-height:500px; max-width:500px;" class="img-rounded" src='{{$data->image}}'/>
   </center>
   <br />
   <div>
     <p>
       {!!$data->description!!}
     </p>
  </div>
 </div>
 <br />
 <div class="col-sm-7 col-md-6">
 <div>
   <p>
     {!!$data->explanation!!}
   </p>
 </div>
</div>
</div>
<hr />
<br />
<div style=" background-color:none;" class="row">
 <div class="col-sm-12 col-md-10 col-md-offset-1">
   <iframe id="video1" src="{{$data->video}}" frameborder="0" allowfullscreen></iframe>
 </div>
</div>
<hr />
<br />
    <div style="padding:5px;">
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
               <p>{!!$example->explanation!!}</p><br />
                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#{{$example->id}}answer">Answer</button>
                <div id="{{$example->id}}answer" class="collapse">
                  <h2>The answer is {{$example->answer}}</h2>
                </div>
             </div>
             <div class="col-sm-5">
                <img class="img-rounded" src='{{$example->image}}'/>
                <p>{!!$example->introduction!!}</p><br />
             </div>
            </div>
          </div>
          <?php $y++?>
        @endforeach
        </div>
      @endif
    </div>
</div>

@endsection
