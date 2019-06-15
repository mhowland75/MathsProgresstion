<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="maths, mathsprogression,bath college maths, mathprogression, learning maths">
    <meta name="description" content="Online mathematical learning resource.">
    <meta name="author" content="Michael Howland">
    <meta name="application-name" content="Diagnostic Revision">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Diagnostic Revision') }}</title>

    <!-- Styles -->

    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/mathsprogression.css') }}" rel="stylesheet">
    <link rel="stylesheet" media="screen and (min-width:769px) and (max-width: 992px)" href="{{ URL::asset('css/tablet.css') }}" />
    <link rel="stylesheet" media="screen and (min-width: 451px) and (max-width: 768px)" href="{{ URL::asset('css/smallTablet.css') }}" />
    <link rel="stylesheet" media="screen and (min-width: 201px) and (max-width: 450px)" href="{{ URL::asset('css/mobile.css') }}" />
    <link href="{{ URL::asset('css/footer.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/navbar.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/ionicons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
      bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
//]]>
</script>
<script>
/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "navBar") {
        x.className += " responsive";
    } else {
        x.className = "navBar";
    }
}
function displayBlock() {
  var element = document.getElementById('sideNav'),
    style = window.getComputedStyle(element),
    top = style.getPropertyValue('width');
  if(top == "0px"){
      document.getElementById('sideNav').style.cssText = 'width:300px';
  }
  else{
      document.getElementById('sideNav').style.cssText = 'width:0px';
  }
}
</script>
</head>
<body>
  <div class="navBar" id="myTopnav">
      <a id="nav_logo" href="{{ url('/') }}">
          <img src="/images/bathCollegeLogo.png" />
      </a>
      <div class="dropdownBox">
        <button class="dropbtnx">
            <a href="#">Lessons</a>
        </button>
        <div class="dropdown-content">
          @foreach($lessonSubjects as $subject)
            <a href="/education/index/{{$subject->id}}">{{$subject->subject}}</a>
          @endforeach
        </div>
      </div>
      <div class="dropdownBox">
        <button class="dropbtnx">
            <a href="#">Tests</a>
        </button>
        <div class="dropdown-content">
          @foreach($testSubjects as $subject)
            <a href="/test/index/{{$subject->id}}">{{$subject->subject}}</a>
          @endforeach
        </div>
      </div>
      <a href="/results/view">Results</a>
      <a href="/help/view">Help</a>
      @if (Auth::id())
          <a href="/home">Backend</a>
      @endif

      @if(!empty($student[0]->student_id))
      <div style="float:right; margin-right:10%">
        <div class="dropdownBox">
          <button class="dropbtnxLogin">
              <a href="/home">
                  Hello {{$student[0]->firstname}}<br />{{$student[0]->student_id}}
              </a>
          </button>
          <div class="dropdown-content">
            <a href="/student/logout">Logout</a>
            <a href="/student/password_reset">Change Password</a>
          </div>
        </div>
      </div>
      @else
      <div style="float:right; margin-right:10%">
        <div style="margin-top:15px" class="login-container">
          <form method="POST" action="/student/login">
            {{ csrf_field() }}
            <input id="login-text-box" placeholder=" Student ID"  type="student_id" name="student_id">
            <input id="login-text-box" placeholder=" Password"  type="password" name="password">
            <button type="submit" class="btn btn-primary btn-sm">Login</button>
          </form>
        </div>
      </div>
      @endif
  <a href="javascript:void(0);" class="icon" onclick="displayBlock()">&#9776;</a>
</div>
<div id="sideNav">
  <div>
    <a href="/education/index/maths">Maths</a>
    <a href="/education/index/english">English</a>
    <a href="/help/view">Help</a>
  </div>
</div>
          @yield('banner')
        <div id="page">
            @yield('content')
        </div>

    @include('layouts.footer')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
</body>
</html>
