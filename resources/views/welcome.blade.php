@extends('layouts.app')
@section('banner')
<div id="indexBanner" class="jumbotron">
  <div id="indexBannerText">
    <h3>Welcome to</h3>
    <br />
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
<div>
  <br />
  <center>
    <p style="font-size: 150%; font-weight: bold;">
      MathsProgression has been created to provide Bath college students with a learning resources to aid them in passing the online maths tests at Diagnostic Questions.
      <br />
      We hope you find this website helpful and good luck passing your exams.
    </p>
  </center>
  <br />
</div>

  <div class="row">
   <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-0">
     <center>
       <div style="background: radial-gradient(white 50%, #f4f6f7 ) " class="panel panel-default">
         <div style="margin:auto" class="panel-body">
         <h3>Ready to test yourself?</h3><br />
          <a href="https://diagnosticquestions.com/">
          <div id="dqImage">
            <img src="/images/dq logo.png" />
          </div>
        </a>
          <h2>Diagnostic Questons</h2>
        </div>
        </div>
     </center>
   </div>
   <div class=" col-md-6 col-md-offset-0">
     <img id="indexImage" class="img-rounded" src="/images/computer.jpg" />
   </div>
  </div>

@endsection
