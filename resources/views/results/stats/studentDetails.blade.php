@extends('layouts.backend')
@section('content')
<div class="page-header">
  <h1>{{$sDetails[0]->firstname}} {{$sDetails[0]->surname}} - {{$sDetails[0]->student_id}}</h1>
</div>
<div class="row">
 <div class="col-sm-2">
   <div class="vertical-menu">
    <a href="/results/overallStats"><b>Overall Stats</b></a>
    <a href="/results/departments"><b>Departments</b></a>
    @foreach ($nav as $x=>$y)
     <a href="/results/{{$x}}/course"><b>{{$x}}</b></a>
       @foreach ($y as $p)
        <a href="/results/{{$p}}/student"><p style='font-size: 90%;'>{{$p}}</p></a>
       @endforeach
    @endforeach
   </div>
 </div>
 <div class="col-sm-10">
   <div class="row">
     <div class="col-sm-6">
       @foreach ($sDetails as $x)
           <div class="panel panel-default">
             <div class="panel-heading"><b>Student Details</b></div>
             <div class="panel-body">
           <div class="row">
             <div class="col-sm-6">Student ID</div>
             <div class="col-sm-6">{{$x->student_id}}</div>
           </div>
           <div class="row">
             <div class="col-sm-6">Firstname</div>
             <div class="col-sm-6">{{$x->firstname}}</div>
           </div>
           <div class="row">
             <div class="col-sm-6">Surname</div>
             <div class="col-sm-6">{{$x->surname}}</div>
           </div>
           <div class="row">
             <div class="col-sm-6">DOB</div>
             <div class="col-sm-6">{{$x->dob}}</div>
           </div>
           <div class="row">
             <div class="col-sm-6">Department</div>
             <div class="col-sm-6">{{$x->dept}}</div>
           </div>
           <div class="row">
             <div class="col-sm-6">Course</div>
             <div class="col-sm-6">{{$x->course}}</div>
           </div>
           <div class="row">
             <div class="col-sm-6">GCSE Grade</div>
             <div class="col-sm-6">{{$x->gcse_maths_grade}}</div>
           </div>
           <div class="row">
             <div class="col-sm-6">Tutor</div>
             <div class="col-sm-6">{{$x->primary_tutor}}</div>
           </div>
           <div class="row">
             <div class="col-sm-6">Withdrawn</div>
             <div class="col-sm-6">{{$x->withdrawn}}</div>
           </div>
         </div>
       @endforeach
     </div>
   </div>

     <div class="col-sm-6">
       <div class="panel panel-default">
        <div class="panel-heading"><b>{{$sDetails[0]->firstname}} {{$sDetails[0]->surname}} Results</b></div>
        <div class="panel-body"><div id="chart_div"></div></div>
      </div>

     </div>
   </div>
   <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <table class="table table-striped">
            <thead>
              <tr>
                <th></th>
                @foreach ($quizList as $quiz)
                 <th style="font-size:12px">{{$quiz['quiz_name']}}</th>
                @endforeach
              </tr>
            </thead>
            <tbody id="myTable">
              <tr>
                <td><b>Results</b></td>
                @foreach ($noSpaceQuizList as $quizNoS)
                  <td><?php if(!empty($array[$quizNoS]['result'])){echo $array[$quizNoS]['result'];}else{echo'<p style="color:purple">Not Started</p>';} ?></td>
                @endforeach
              </tr>
              <tr>
                <td><b>Start Date</b></td>
                @foreach ($noSpaceQuizList as $quizNoS)
                  <td><?php if(!empty($array[$quizNoS]['startDate'])){echo $array[$quizNoS]['startDate'];}else{echo'<p style="color:purple">Not Started</p>';} ?></td>
                @endforeach
              </tr>
              <tr>
                <td><b>Date Started</b></td>
                @foreach ($noSpaceQuizList as $quizNoS)
                  <td><?php if(!empty($array[$quizNoS]['dateStarted'])){echo $array[$quizNoS]['dateStarted'];}else{echo'<p style="color:purple">Not Started</p>';} ?></td>
                @endforeach
              </tr>
              <tr>
                <td><b>Date compleated</b></td>
                  @foreach ($noSpaceQuizList as $quizNoS)
                    <td><?php if(!empty($array[$quizNoS]['dateCom'])){echo $array[$quizNoS]['dateCom'];}else{echo'<p style="color:purple">Not Started</p>';} ?></td>
                  @endforeach
              </tr>
              <tr>
                <td><b>Due Date</b></td>
                @foreach ($noSpaceQuizList as $quizNoS)
                  <td><?php if(!empty($array[$quizNoS]['dateDue'])){echo $array[$quizNoS]['dateDue'];}else{echo'<p style="color:purple">Not Started</p>';} ?></td>
                @endforeach
              </tr>
            </tbody>
            </table>
          </div>
        </div>
      </div>
   </div>
 </div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Passed', {{$passed}}],
          ['Incompleate', {{$incompleate}}],
        ]);

        // Set chart options
        var options = {'title':'',
                       'width':400,
                       'height':200};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

@endsection
