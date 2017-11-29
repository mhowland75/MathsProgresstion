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
    <link rel="stylesheet" media="screen and (min-width: 501px) and (max-width: 1028px)" href="{{ URL::asset('css/tablet.css') }}" />
    <link rel="stylesheet" media="screen and (min-width: 201px) and (max-width: 500px)" href="{{ URL::asset('css/mobile.css') }}" />
    <link href="{{ URL::asset('css/footer.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/navbar.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/ionicons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
      bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
//]]>
</script>
</head>
<body>
    <div id="app">
      <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container">
              <div class="navbar-header">

                  <!-- Collapsed Hamburger -->
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                      <span class="sr-only">Toggle Navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>

                  <!-- Branding Image -->
                  <a class="navbar-brand" href="{{ url('/') }}">
                      <img src="/images/bath college logo.png" />
                  </a>
              </div>

              <div class="collapse navbar-collapse" id="app-navbar-collapse">
                  <!-- Left Side Of Navbar -->
                  <ul id="navbar" class="nav navbar-nav">
                        <li><a href="/departments/view">Diagnostic Questions</a></li>
                        <li><a href="/education/index">Education</a></li>
                        <li><a href="/help/view">Help</a></li>
                        @if (Auth::id())
                          <li><a href="/home">Backend</a></li>
                        @endif
                  </ul>

                  <!-- Right Side Of Navbar -->
                  <ul class="nav navbar-nav navbar-right">
                    <div id='medialinks'>
                        <a href="https://www.facebook.com/MathsProgression-1782215791819800/" class="fa fa-facebook"></a>
                        <a href="#" class="fa fa-twitter"></a>
                        <a href="#" class="fa fa-google"></a>
                        <a href="#" class="fa fa-linkedin"></a>
                    </div>
                      <!-- Authentication Links
                      @guest
                          <li><a href="{{ route('login') }}">Login</a></li>
                          <li><a href="{{ route('register') }}">Register</a></li>
                      @else
                          <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                  {{ Auth::user()->name }} <span class="caret"></span>
                              </a>

                              <ul class="dropdown-menu" role="menu">
                                  <li>
                                      <a href="{{ route('logout') }}"
                                          onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                          Logout
                                      </a>

                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                          {{ csrf_field() }}
                                      </form>
                                  </li>
                              </ul>
                          </li>
                      @endguest
                  </ul>
                  -->
              </div>
          </div>
      </nav>
          @yield('banner')
        <div id="page">
            @yield('content')
        </div>

    </div>
    @include('layouts.footer')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
