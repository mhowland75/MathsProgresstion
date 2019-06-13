@extends('layouts.app')
@section('banner')
  <div id="titleBanner">
    <center>
      <h1>Results</h1>
    </center>
  </div>
@endsection
@section('content')
<div class="row">
 <div class="col-sm-12">
   @foreach($array as $key => $subject)
   <div style="padding:1px; margin-bottom:50px; height:170px;" class="row">
     @if($subject['students'][0]['overallResult']['overAll'] == 'Pass')
     <div style="background-color:  #2ecc71; height:inherit; border-radius:10px 0px 0px 10px; border-right:2px solid  #239b56; padding-top:15px; " class="col-sm-3">
       <center>
         <p style="font-size:30px; font-weight:bold; color:black; margin:20px">
           {{$key}}
         </p>
         <p style="font-size:30px; color:black;">
           {{$subject['students'][0]['overallResult']['overAll']}}
         </p>
       </center>
     </div>
     @else
     <div style="background-color: #e74c3c; height:inherit; border-radius:10px 0px 0px 10px; border-right:2px solid  red; padding-top:15px" class="col-sm-3">
       <center>
         <p style="font-size:30px; font-weight:bold; color:black; margin:20px">
           {{$key}}
         </p>
         <p style="font-size:30px; color:black;">
           {{$subject['students'][0]['overallResult']['overAll']}}
         </p>
       </center>
     </div>
     @endif
     <div style="height:inherit; border-style: solid; border-width: 1px; border-color:gray; border-radius:0px 10px 10px 0px;" class="col-sm-9">
       <table class="table table-striped">
       <thead>
         <tr>
           @foreach($subject['tests'] as $test)
           <th>
             {{$test->name}}<br />
             <p>
               Passmark: {{$test->passmark}}
             </p>
           </th>
           @endforeach
           <th>
             Total Passed
           </th>
         </tr>
       </thead>
       <tbody>
         @foreach($subject['students'] as $student)
         <tr>
           @foreach($student['tests'] as $test)
           @if(!empty($test['result']->id))
           <td>
             @if($test['result']->correct_answers >= $test->passmark)
              <p style="color:green; font-weight:bold">
                {{$test['result']->correct_answers}}/{{$student['tests']->count()}}
              </p>
              @else
              <p style="color:red; font-weight:bold">
                {{$test['result']->correct_answers}}/{{$student['tests']->count()}}
              </p>
             @endif
           </td>
           @else
           <td>
             <p style="color:red; font-weight:bold">
               N/A
             </p>
           </td>
           @endif
           @endforeach
           <td>
             <b>
               {{$student['overallResult']['passed']}}
             </b>
           </td>
         </tr>
         @endforeach
       </tbody>
       </table>
     </div>
    </div>
   @endforeach
 </div>
</div>
@endsection
