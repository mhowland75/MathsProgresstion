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
            <th>Pythagoras Theorem</th>
            <th>Expanding two brackets</th>
            <th>Perimeter Of A Semi Circle</th>
            <th>Compound Interest</th>
            <th>Reverse Percentages</th>
            <th>Standard Form</th>
            <th>Rearranging Formula</th>
            <th>Volume Of A Prism</th>
            <th>Trigonometry</th>
          </tr>
        </thead>
        <tbody id="myTable">
          @foreach ($results as $sId=>$x)
          <tr>
            <td><a href="/results/{{$sId}}/studentdetails">{{$sId}}<br />{{$x['name']}}</a></td>
            <td><?php if(!empty($x['PythagorasTheorem'])){echo $x['PythagorasTheorem'];}else{echo'<p style="color:purple">Not Started</p>';} ?></td>
            <td><?php if(!empty($x['Expandingtwobrackets'])){echo $x['Expandingtwobrackets'];}else{echo'Not Started';} ?></td>
            <td><?php if(!empty($x['PerimeterOfASemiCircle'])){echo $x['PerimeterOfASemiCircle'];}else{echo'Not Started';} ?></td>
            <td><?php if(!empty($x['CompoundInterest'])){echo $x['CompoundInterest'];}else{echo'Not Started';} ?></td>
            <td><?php if(!empty($x['ReversePercentages'])){echo $x['ReversePercentages'];}else{echo'Not Started';} ?></td>
            <td><?php if(!empty($x['StandardForm'])){echo $x['StandardForm'];}else{echo'Not Started';} ?></td>
            <td><?php if(!empty($x['RearrangingFormula'])){echo $x['RearrangingFormula'];}else{echo'Not Started';} ?></td>
            <td><?php if(!empty($x['VolumeOfAPrism'])){echo $x['VolumeOfAPrism'];}else{echo'Not Started';} ?></td>
            <td><?php if(!empty($x['Trigonometry'])){echo $x['Trigonometry'];}else{echo'Not Started';} ?></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
    </div>
</div>

</div>
@endsection
