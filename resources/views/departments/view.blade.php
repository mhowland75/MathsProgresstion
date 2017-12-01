@extends('layouts.app')
@section('banner')
<div id="bannerDepartments" class="jumbotron">
  <center>
    <h1>Diagnostic Questions</h1>
    <p>Find your group code by clicking your department.</p>
  </center>
</div>
@endsection
@section('content')
<div class="panel-body">
  <div class="row">
   <div class="col-xs-12 col-sm-6">
       <div class="panel-group" id="accordion">
         <?php $y = 0; ?>
         @forelse ($results as $result)
         <div class="panel panel-default">
             <div class="panel-heading">
               <h4 class="panel-title">
                 <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$y}}">
                   <center><b>{{$result[0]->department}}</b></center></a>
               </h4>
             </div>
             <div id="collapse{{$y}}" class="panel-collapse collapse">
             @foreach ($result as $x)

             <div class="panel-body">
               <div class="row">
                <div class="col-xs-6 col-sm-6">{{ $x->course_name }}</div>
                <div class="col-xs-6 col-sm-6">{{ $x->group_code }}</div>
               </div>
             </div>

             <?php $y++;?>
             @endforeach
             </div>
           </div>
           @empty
           @endforelse
         </div>
   </div>

   <div class="col-xs-12 col-sm-6">
     <div class="panel panel-default">
      <div class="panel-body">
        <center>
          <h2>
            When logging into Diagnostic Questions for the first time you will need to do the following
          </h2>
        </center>
        <br />
        <ol>
         <li>Set your username as your student ID, e.g ARK14286357.</li>
         <li>Create a password that you will easily be able to remember as you will have to access this website in the future.</li>
         <li>Ensure that you find out your group code from the Department options on the left to ensure that you register yourself into the correct group.</li>
       </ol>
       <br />
         <center>
           <a href="https://diagnosticquestions.com/">
             <div id="dqImage">
               <img src="/images/dq logo.png" />
             </div>
           </a>
         </center>
       <br />
       <center>
          <a href="https://diagnosticquestions.com/"><button type="button" class="btn btn-primary btn-lg">Continue to <br /> Diagnostic Questions</button></a>
       </center>
        <br /><br />
      </div>
    </div>


   </div>
  </div>
</div>



@endsection
