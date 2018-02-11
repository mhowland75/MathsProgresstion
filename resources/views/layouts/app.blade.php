<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="maths, mathsprogression,bath college maths, mathprogression, learning maths">
    <meta name="description" content="Online mathematical learning resource.">
    <meta name="author" content="Michael Howland">
    <meta name="application-name" content="MathsProgression">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/mathsprogression.css') }}" rel="stylesheet">
    <link rel="stylesheet" media="screen and (min-width:769px) and (max-width: 992px)" href="{{ URL::asset('css/tablet.css') }}" />
    <link rel="stylesheet" media="screen and (min-width: 201px) and (max-width: 768px)" href="{{ URL::asset('css/mobile.css') }}" />
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
      <a href="/education/index/maths">Maths</a>
      <a href="/education/index/english">English</a>
      <a href="/departments/view">Diagnostic Questions</a>
      <a href="/help/view">Help</a>
      @if (Auth::id())
        <a href="/home">Backend</a>
      @endif
  <a href="javascript:void(0);" class="icon" onclick="displayBlock()">&#9776;</a>
</div>
<div id="sideNav">
  <div>
    <a href="/education/index/maths">Maths</a>
    <a href="/education/index/english">English</a>
    <a href="/departments/view">Diagnostic Questions</a>
    <a href="/help/view">Help</a>
    @if (Auth::id())
      <a href="/home">Backend</a>
    @endif
  </div>
</div>
          @yield('banner')
        <div id="page">
            @yield('content')
        </div>

    @include('layouts.footer')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
