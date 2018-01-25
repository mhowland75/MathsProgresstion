@extends('layouts.backend')
@section('content')
<div class="page-header">
  <h1>Departments</h1>
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
 <div class="col-sm-10 ">
   <div class="panel-body">
     <div class="panel panel-default">
       <div class="panel-heading">Passed</div>
       <table class="table table-striped">
       <thead>
         <tr>
           <th>Department</th>
           <th>Passed Tests</th>
           <th>Total Tests</th>
           <th>% Passed of All Tests</th>
           <th>% passed of Complete Tests</th>
           <th>Passed quizes </th>
           <th>Total Quizes</th>
           <th>% Passed quizes </th>
         </tr>
       </thead>
       <tbody id="myTable">
         @foreach ($array as $x)
         <tr>
           <td><a href="/results/{{$x['Tests']['dpt']}}/course">{{$x['Tests']['dpt']}}</a></td>
             <td>{{$x['Tests']['passedTests']}}</td>
             <td>{{$x['Tests']['total']}}</td>
             <td>{{$x['Tests']['percPassed']}}%</td>
             <td>{{$x['Tests']['perPassOfCom']}}%</td>
             <td>{{$x['quizes']['passedOfCom']}}</td>
             <td>{{$x['quizes']['totalQuiz']}}</td>
             <td>{{$x['quizes']['passPerOfCom']}}%</td>
         </tr>
         @endforeach
       </tbody>
     </table>
     </div>
     </div>
   <div class="panel-body">
     <div class="panel panel-default">
       <div class="panel-heading">Compleated</div>
       <table class="table table-striped">
       <thead>
         <tr>
           <th>Department</th>
           <th>Compleated Tests</th>
           <th>Total Tests</th>
           <th>% Compleated Tests</th>
           <th>Compleated Quizes</th>
           <th>Total Quizes</th>
           <th>% Compleated Quizes</th>
         </tr>
       </thead>
       <tbody id="myTable">
         @foreach ($array as $x)
         <tr>
           <td><a href="/results/{{$x['Tests']['dpt']}}/course">{{$x['Tests']['dpt']}}</a></td>
           <td>{{$x['Tests']['totalCom']}}</td>
           <td>{{$x['Tests']['total']}}</td>
           <td>{{$x['Tests']['perCom']}}%</td>
           <td>{{$x['quizes']['totalCom']}}</td>
            <td>{{$x['quizes']['totalQuiz']}}</td>
           <td>{{$x['quizes']['perComQuiz']}}%</td>

         </tr>
         @endforeach
       </tbody>
     </table>
     </div>
     </div>
   <div class="panel-body">
     <div class="panel panel-default">
       <div class="panel-heading">Attempted</div>
       <table class="table table-striped">
       <thead>
         <tr>
           <th>Department</th>
           <th>Attempted Tests</th>
           <th>Total Tests</th>
           <th>% Tests Attempted</th>
           <th>Attempted Quizes</th>
           <th>Total Quizes</th>
           <th>% Attempted Quizes</th>
         </tr>
       </thead>
       <tbody id="myTable">
         @foreach ($array as $x)
         <tr>
           <td><a href="/results/{{$x['Tests']['dpt']}}/course">{{$x['Tests']['dpt']}}</a></td>
              <td>{{$x['Tests']['attemptedTests']}}</td>
              <td>{{$x['Tests']['total']}}</td>
              <td>{{$x['Tests']['perAttemptedTests']}}%</td>
              <td>{{$x['quizes']['AttemptedQuizes']}}</td>
              <td>{{$x['quizes']['totalQuiz']}}</td>
              <td>{{$x['quizes']['perAttemptedQuizes']}}%</td>
         </tr>
         @endforeach
       </tbody>
     </table>
     </div>
     </div>
 </div>
</div>

@endsection
