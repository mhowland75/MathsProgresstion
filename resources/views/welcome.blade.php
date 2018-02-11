@extends('layouts.app')
@section('banner')
<div id="indexBanner" class="jumbotron">
  <div id="indexBannerText">
    <h3>Welcome to</h3>
    <h1>Diagnostic Revision</h1>
  </div>
</div>
@endsection
@section('content')
<div>
  <hr />
  <br />
  <center>
    <p id="indexText">
      Diagnostic Revision has been created to provide Bath College students with a learning resource to aid them in passing the online maths and english tests at Diagnostic Questions.
      <br />
      We hope you find this website helpful and good luck with passing your exams.
    </p>
  </center>
  <br />
</div>
<hr />
  <br />
<div class="row">
  <div class="col-xs-6 col-sm-4">
    <div class="panel panel-default">
      <div class="panel-body">
        <center>
          <div id="dqImage">
            <img src="/images/maths_logo.jpg" />
          </div>
          <h3>Maths Test Preperation</h3><br />
          <a href="/education/index/maths"><button type="button" class="btn btn-success btn-lg">Maths Revision</button></a>
        </center>
      </div>
    </div>
  </div>
  <div class="col-xs-6 col-sm-4">
    <div class="panel panel-default">
      <div class="panel-body">
        <center>
          <div id="dqImage">
            <img src="/images/book.png" />
          </div>
          <h3>English Test Preperation</h3><br />
          <a href="/education/index/english"><button type="button" class="btn btn-success btn-lg">English Revision</button></a>
        </center>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="panel panel-default">
      <div style="max-width:300px;" class="panel-body">
        <center>
          <div>
            <div id="dqImage">
              <img src="/images/dq logo.png" />
            </div>
          </div>
          <h3>Ready to test yourself?</h3><br />
          <a href="https://diagnosticquestions.com/"><button type="button" class="btn btn-success btn-lg">Diagnostic Questions</button></a>
        </center>
      </div>
    </div>
  </div>
</div>

@endsection
