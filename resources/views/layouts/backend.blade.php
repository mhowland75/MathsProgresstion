<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/mathsprogression.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/navbar.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/footer.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/ionicons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
    <script type="text/javascript">
    //<![CDATA[
          bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
          new nicEditor().panelInstance('description');
    //]]>
    </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
    $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
    });
    });
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
                          <li><a href="/home">Home</a></li>
                          <li><a href="/departments/index">Diagnostic Questions</a></li>
                          <li><a href="/education/manage">Education</a></li>
                          <li><a href="/teachers/manage">Staff</a></li>

                          <li  id="dropdown" class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin</a>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="/admin/manage">Manage</a></li>
                                <li><a href="/admin/manageAccess">Administrator Privileges</a></li>
                              </ul>
                          </li>
                          <li  id="dropdown" class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Results</a>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="/results/create">Upload</a></li>
                                <li><a href="/results/index">Raw data</a></li>
                                <li><a href="/results/departments">Departments</a></li>

                              </ul>
                          </li>
                          <li  id="dropdown" class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Students</a>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="/student/create">Upload</a></li>
                                <li><a href="/student/index">Raw data</a></li>

                              </ul>
                          </li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
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
                </div>
            </div>
        </nav>
        <div id="page">
            @yield('content')
        </div>

    </div>
    @include('layouts.footer')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
