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
    <link href="{{ URL::asset('css/backend.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/backendNavbar.css') }}" rel="stylesheet">
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
  /* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
  function myFunction() {
      var x = document.getElementById("myTopnav");
      if (x.className === "navBar") {
          x.className += " responsive";
      } else {
          x.className = "navBar";
      }
  }
  </script>

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
  <div class="navBar" id="myTopnav">
    <a id="nav_logo" href="{{ url('/') }}">
        <img src="/images/bathCollegeLogo.png" />
    </a>
    <a href="/home">Home</a>
    <a href="/departments/index">Diagnostic Questions</a>
    <a href="/education/manage">Education</a>
    <a href="/teachers/manage">Staff</a>
    <div class="dropdownBox">
      <button class="dropbtnx"><a href="#">Admin</a>

      </button>
      <div class="dropdown-content">
        <a href="/admin/manage">Manage</a>
        <a href="/admin/manageAccess">Administrator Privileges</a>
        <a href="/admin/activity">Activity</a>
      </div>
    </div>
    <div class="dropdownBox">
      <button class="dropbtnx">
          <a href="#">Results</a>

      </button>
      <div class="dropdown-content">
        <a href="/results/overallStats">Overall Results</a>
        <a href="/results/departments">Results</a>
        <a href="/results/create">Results Upload</a>
        <a href="/student/create">Student Upload</a>
        <a href="/results/index">Results Data</a>
        <a href="/student/index">Student Data</a>
        <a href="/results/passMark">Pass Mark</a>
      </div>
    </div>
  <a href="javascript:void(0);" class="icon" onclick="displayBlock()">&#9776;</a>
</div>
    <div id="page">
        @yield('content')
    </div>
    </div>
    @include('layouts.footer')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
