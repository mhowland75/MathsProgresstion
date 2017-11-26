@extends('layouts.app')
@section('banner')
<div id="indexBanner" class="jumbotron">
  <div id="indexBannerText">
    <h3>Welcome to</h3>
    <h1>MathsProgression</h1>
    <h3>We are here to help</h3>
    <center>
      <br /> <br />
      <a href="/education/index"><button type="button" class="btn btn-success btn-lg">Start Learning</button></a>
    </center>
  </div>
</div>
@endsection
@section('content')

<div class="container">
  <div class="row" style="height:400px">
   <div class="col-sm-6">
     <center>
       <div style="background: radial-gradient(white 50%, #f4f6f7 ) " class="panel panel-default">
         <div style="margin:auto" class="panel-body">
         <h3>Ready to test yourself?</h3><br />
          <a href="https://diagnosticquestions.com/"><img width="46%" src="/public/images/dq logo.png" /></a>
          <h2>Diagnostic Questons</h2>
        </div>
        </div>
     </center>
   </div>
   <div class="col-sm-6">
     <img class="img-rounded" src="/storage/computer.jpg" />
   </div>
  </div>
</div>
@endsection
