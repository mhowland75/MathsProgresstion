@extends('layouts.app')
@section('banner')
  <div id="titleBanner">
    <center>
      <h1>{{$studentResults->student_answers[0]->questions->test->name}} Results</h1>
    </center>
  </div>
@endsection
@section('content')
@if($studentResults->correct_answers >= $studentResults->test->passmark)
<div class="row" style=" height:170px;">
  <div class="col-sm-3" style="background-color:#2ecc71; height:inherit;">
    <center>
      <p style="color:black; font-size:30px; margin-top:20%">
          Score<br /><br /> <b>{{$studentResults->correct_answers}} / {{$studentResults->total_questions}}</b>
      </p>
    </center>
  </div>
 <div class="col-sm-6" style=" height:inherit; background-color:#abebc6 ; padding:50px;">
   <center>
     <p style="font-size:50px; line-height: 50px; font-weight:bold; color:black">
       Congratulations
     </p>
     <p style="font-size:30px; color:black">
       You Have Passed!!
     </p>
   </center>
  </div>
  <div class="col-sm-3" style="background-color: #2ecc71; height:inherit;">
    <center>
      <p style="color:black; font-size:30px; margin-top:20%;">
          Passmark<br /> <br /> <b>{{$studentResults->test->passmark}}</b>
      </p>
    </center>
  </div>
 </div>
@else
    <div class="row" style=" height:170px;">
      <div class="col-sm-3" style="background-color:#e74c3c; height:inherit;">
        <center>
          <p style="color:black; font-size:30px; margin-top:20%">
              Score<br /><br /> <b>{{$studentResults->correct_answers}} / {{$studentResults->total_questions}}</b>
          </p>
        </center>
      </div>
     <div class="col-sm-6" style=" height:inherit; background-color:#f1948a ; padding:50px;">
       <center>
         <p style="font-size:50px; line-height: 50px; font-weight:bold; color:black">
           Unlucky
         </p>
         <p style="font-size:30px; color:black">
           Try Again
         </p>
       </center>
      </div>
      <div class="col-sm-3" style="background-color: #e74c3c; height:inherit;">
        <center>
          <p style="color:black; font-size:30px; margin-top:20%;">
              Passmark<br /> <br /> <b>{{$studentResults->test->passmark}}</b>
          </p>
        </center>
      </div>
     </div>
@endif
  @foreach($studentResults->student_answers as $answer)
    @if($answer->correct)
      <div style="padding:5px; margin:10px; height:60px;" class="row">
       <div style="background-color:  #2ecc71; height:inherit; border-radius:10px 0px 0px 10px; border-right:2px solid  #239b56 " class="col-sm-2">
         <p style="font-size:30px; font-weight:bold; color:black; margin:20px">
           Correct
         </p>
       </div>
       <div style="background-color: #abebc6; height:inherit" class="col-sm-9">
         <p style=" float:left; font-weight:bold; font-size:20px; color:black; margin:20px; margin-right:0px;">{{$answer->questions->question}} -</p>
         <p style="float:left; margin:20px; margin-left:5px; font-size:20px; color:black;">{{$answer->answers->answers}}</p>
       </div>
       <div style="background-color:  #2ecc71; height:inherit; border-radius:0px 10px 10px 0px; border-left:2px solid  #239b56 " class="col-sm-1">
           <i style="font-size:40px; color:black; float:right; margin-right:20%" class="ion-checkmark-round"></i>
       </div>
      </div>
    @else
    <div style="padding:5px; margin:10px; height:60px;" class="row">
     <div style="background-color:   #e74c3c ; height:inherit; border-radius:10px 0px 0px 10px; border-right:2px solid   #b03a2e  " class="col-sm-2">
       <p style="font-size:30px; font-weight:bold; color:black; margin:20px">
         Incorrect
       </p>
     </div>
     <div style="background-color:  #f1948a; height:inherit" class="col-sm-9">
       <p style=" float:left; font-weight:bold; font-size:20px; color:black; margin:20px; margin-right:0px;">{{$answer->questions->question}} -</p>
       <p style="float:left; margin:20px; margin-left:5px; font-size:20px; color:black;">{{$answer->answers->answers}}</p>
     </div>
     <div style="background-color:   #e74c3c; height:inherit; border-radius:0px 10px 10px 0px; border-left:2px solid   #b03a2e  " class="col-sm-1">
         <i style="font-size:40px; color:black; float:right; margin-right:20%" class="ion-close-round"></i>
     </div>
    </div>
    @endif
  @endforeach

@endsection
