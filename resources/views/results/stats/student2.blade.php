@extends('layouts.backend')

@section('content')

<div class="row">
 <div class="col-sm-8">
   <div class="page-header">
     <center>
       <h1>{{$course}} Course</h1>
     </center>
   </div>
 </div>
 <div class="col-sm-4">
   <input style="margin-top:30px" class="form-control" id="myInput" type="text" placeholder="Search..">
 </div>
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
     <div class="col-sm-4">
       <center>
         <p>
           <b style="color:#2be973">Green</b> - Passed
         </p>
       </center>
     </div>
     <div class="col-sm-4">
       <center>
         <p>
           <b style="color:red">Red</b> - Compleated not passed
         </p>
       </center>
     </div>
     <div class="col-sm-4">
       <center>
         <p>
           <b style="color:purple">Purple</b> - Incompleate
         </p>
       </center>
     </div>
    </div>
    <div class="panel panel-default">
    <div class="panel-body">
      <table class="table table-striped">
      <thead>
        <tr>
          <th>Student ID</th>
          <th>Passed Test</th>
          <th>Quizes Passed</th>
          <th>Quizes Compleated</th>
          <th>Quizes Attempted</th>
        </tr>
      </thead>
      <tbody id="myTable">
        @foreach ($results as $sId=>$x)
        <tr>
          <td><a href="/results/{{$sId}}/studentdetails">{{$sId}}<br />{{$x['name']}}</a></td>
          <td><p style="color:black">{!!$x['passedTest']!!}</p></td>
          <td><p style="color:black">{{$x['passedQuizes']}}</p></td>
          <td><p style="color:black">{{$x['comQuizes']}}</p></td>
          <td><p style="color:black">{{$x['attemptedQuizes']}}</p></td>

        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  </div>
      <div class="panel panel-default">
      <div class="panel-body">
        <table class="table table-striped">
        <thead>
          <tr>
            <th>Student ID</th>
            @foreach ($quizList as $list)
              <th>{{$list['quiz_name']}}</th>
            @endforeach
          </tr>
        </thead>
        <tbody id="myTable">
          @foreach ($results as $sId=>$x)
          <tr>
              <td><a href="/results/{{$sId}}/studentdetails">{{$sId}}<br />{{$x['name']}}</a></td>
            @foreach ($noSpaceQuizList as $noSlist)
              <td><?php if(!empty($x[$noSlist])){echo $x[$noSlist];}else{echo'<p style="color:purple">Not Started</p>';} ?></td>
            @endforeach
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
    </div>
</div>


</div>
@endsection
