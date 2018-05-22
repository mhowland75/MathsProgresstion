@extends('layouts.backend')

@section('content')
<div class="row">
  <div class="col-sm-4">
    <div class="row">
      <div class="col-sm-4">
        <a style="text-decoration: none;" href="help/index">
        <div style="background-color: red;" id="dashboardBox">
          <i style="font-size:40px" class="ion-android-mail"></i><br />
          <p>
            {{$newMail}}
            <br />
            New Messages
          </p>
      </div>
      </a>
    </div>
      <div class="col-sm-4">
        <a style="text-decoration: none;" href="/education/manage">
          <div style="background-color: blue;" id="dashboardBox">
            <p style="font-size:40px; ">{{$totalLessons}}</p>
            <p>
              Lessons<br /> {{$activeLessons}} Active
            </p>
          </div>
        </a>
      </div>
      <div class="col-sm-4">
        <a style="text-decoration: none;" href="/departments/index">
          <div style="background-color: yellow;" id="dashboardBox">
            <p style="font-size:40px; ">{{$courses}}</p>
            <p>
              Courses
            </p>
          </div>
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <a style="text-decoration: none;" href="/teachers/manage">
        <div style="background-color: pink;" id="dashboardBox">
          <i style="font-size:40px" class="ion-android-contact"></i><br />
          <p>
            {{$teachers}}
            Staff
          </p>
      </div>
      </a>
      </div>
      <div class="col-sm-8">
        <a style="text-decoration: none;" href="/education/popularity">
        <div style="background-color: darkblue;" id="dashboardBox">
          <i style="font-size:40px" class="ion-arrow-up-c"></i><br />
          <p>
            Most Populare Lesson is<br />
            <b>{{$mostPopulareLesson['name']}}</b>
            {{$mostPopulareLesson['views']}}
            views
          </p>
      </div>
      </a>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div id="donutchart" style="width: 100%; height: 300px;"></div>
    <div class="row">
      <div class="col-sm-4">
        <a style="text-decoration: none;" href="/results/passMark">
        <div style="background-color: gray;" id="dashboardBox">
          <i style="font-size:40px" class="ion-android-done"></i><br />
          <p>
            {{$passmark}}<br />
            Passmark
          </p>
      </div>
      </a>
      </div>
      <div class="col-sm-4">
        <a style="text-decoration: none;" href="/results/overallStats">
        <div style="background-color: green;" id="dashboardBox">
          <i style="font-size:40px" class="ion-android-people"></i><br />
          <p>
            {{$totalStudents}}<br />
            Total Students
          </p>
      </div>
      </a>
      </div>
      <div class="col-sm-4">
        <a style="text-decoration: none;" href="/results/overallStats">
        <div style="background-color: purple;" id="dashboardBox">
          <p style="font-size:40px">{{$perPassStudents}}%</p>
          <p>
            Students Passed
          </p>
      </div>
      </a>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div id="line_top_x"></div>
    <div class="row">
      <div class="col-sm-8">
        <a style="text-decoration: none;" href="/admin/activity">
        <div style="background-color: brown;" id="dashboardBox">
          <i style="font-size:40px" class="ion-android-globe"></i><br />
          <p>
            {{$totalVisits}}<br />
            Total Visits
          </p>
      </div>
      </a>
      </div>
      <div class="col-sm-4">
        <a style="text-decoration: none;" href="/results/overallStats">
        <div style="background-color: purple;" id="dashboardBox">
          <p style="font-size:40px">{{$perPassStudents}}%</p>
          <p>
            Students Passed
          </p>
      </div>
      </a>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-4">


  </div>
  <div class="col-sm-4">.col-sm-4</div>
  <div class="col-sm-4">.col-sm-4</div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('date', 'Month');
      data.addColumn('number', 'Connections');
      data.addRows([
        @foreach ($bg as $x)
          [new Date({{$x[1]}}),{{$x[0]}}],
        @endforeach
      ]);

      var options = {
        chart: {
          title: 'Connections',
          subtitle: ''
        },

        height: 300,
      };

      var chart = new google.charts.Line(document.getElementById('line_top_x'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
  </script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Passed', 'Students'],
          ['Passed',     {{$passedStudents['passed']}}],
          ['Incompleate',      {{$passedStudents['failed']}}]

        ]);

        var options = {
          title: 'Students Passed',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>

@endsection
