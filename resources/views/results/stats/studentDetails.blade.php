@extends('layouts.backend')
@section('content')
<div class="page-header">
  <h1>{{$sDetails[0]->firstname}} {{$sDetails[0]->surname}} - {{$sDetails[0]->student_id}}</h1>
</div>
<a href="/results/{{$sDetails[0]->course}}/student">Back to {{$sDetails[0]->course}}</a>
<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <table class="table table-striped">
        <thead>
          <tr>
            <th></th>
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
          <tr>
            <td><b>Results</b></td>
            <td><?php if(!empty($array['PythagorasTheorem']['result'])){echo $array['PythagorasTheorem']['result'];}else{echo'<p style="color:purple">Not Started</p>';} ?></td>
              <td><?php if(!empty($array['Expandingtwobrackets']['result'])){echo $array['Expandingtwobrackets']['result'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['PerimeterOfASemiCircle']['result'])){echo $array['PerimeterOfASemiCircle']['result'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['CompoundInterest']['result'])){echo $array['CompoundInterest']['result'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['ReversePercentages']['result'])){echo $array['ReversePercentages']['result'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['StandardForm']['result'])){echo $array['StandardForm']['result'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['RearrangingFormula']['result'])){echo $array['RearrangingFormula']['result'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['VolumeOfAPrism']['result'])){echo $array['VolumeOfAPrism']['result'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['Trigonometry']['result'])){echo $array['Trigonometry']['result'];}else{echo'Not Started';} ?></td>
          </tr>
          <tr>
            <td><b>Start Date</b></td>
            <td><?php if(!empty($array['PythagorasTheorem']['startDate'])){echo $array['PythagorasTheorem']['startDate'];}else{echo'<p style="color:purple">Not Started</p>';} ?></td>
              <td><?php if(!empty($array['Expandingtwobrackets']['startDate'])){echo $array['Expandingtwobrackets']['startDate'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['PerimeterOfASemiCircle']['startDate'])){echo $array['PerimeterOfASemiCircle']['startDate'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['CompoundInterest']['startDate'])){echo $array['CompoundInterest']['startDate'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['ReversePercentages']['startDate'])){echo $array['ReversePercentages']['startDate'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['StandardForm']['startDate'])){echo $array['StandardForm']['startDate'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['RearrangingFormula']['startDate'])){echo $array['RearrangingFormula']['startDate'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['VolumeOfAPrism']['startDate'])){echo $array['VolumeOfAPrism']['startDate'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['Trigonometry']['startDate'])){echo $array['Trigonometry']['startDate'];}else{echo'Not Started';} ?></td>
          </tr>
          <tr>
            <td><b>Date Started</b></td>
            <td><?php if(!empty($array['PythagorasTheorem']['dateStarted'])){echo $array['PythagorasTheorem']['dateStarted'];}else{echo'<p style="color:purple">Not Started</p>';} ?></td>
              <td><?php if(!empty($array['Expandingtwobrackets']['dateStarted'])){echo $array['Expandingtwobrackets']['dateStarted'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['PerimeterOfASemiCircle']['dateStarted'])){echo $array['PerimeterOfASemiCircle']['dateStarted'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['CompoundInterest']['dateStarted'])){echo $array['CompoundInterest']['dateStarted'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['ReversePercentages']['dateStarted'])){echo $array['ReversePercentages']['dateStarted'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['StandardForm']['dateStarted'])){echo $array['StandardForm']['dateStarted'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['RearrangingFormula']['dateStarted'])){echo $array['RearrangingFormula']['dateStarted'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['VolumeOfAPrism']['dateStarted'])){echo $array['VolumeOfAPrism']['dateStarted'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['Trigonometry']['dateStarted'])){echo $array['Trigonometry']['dateStarted'];}else{echo'Not Started';} ?></td>
          </tr>
          <tr>
            <td><b>Date compleated</b></td>
            <td><?php if(!empty($array['PythagorasTheorem']['dateCom'])){echo $array['PythagorasTheorem']['dateCom'];}else{echo'<p style="color:purple">Not Started</p>';} ?></td>
              <td><?php if(!empty($array['Expandingtwobrackets']['dateCom'])){echo $array['Expandingtwobrackets']['dateCom'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['PerimeterOfASemiCircle']['dateCom'])){echo $array['PerimeterOfASemiCircle']['dateCom'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['CompoundInterest']['dateCom'])){echo $array['CompoundInterest']['dateCom'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['ReversePercentages']['dateCom'])){echo $array['ReversePercentages']['dateCom'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['StandardForm']['dateCom'])){echo $array['StandardForm']['dateCom'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['RearrangingFormula']['dateCom'])){echo $array['RearrangingFormula']['dateCom'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['VolumeOfAPrism']['dateCom'])){echo $array['VolumeOfAPrism']['dateCom'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['Trigonometry']['dateCom'])){echo $array['Trigonometry']['dateCom'];}else{echo'Not Started';} ?></td>
          </tr>
          <tr>
            <td><b>Due Date</b></td>
            <td><?php if(!empty($array['PythagorasTheorem']['dateDue'])){echo $array['PythagorasTheorem']['dateDue'];}else{echo'<p style="color:purple">Not Started</p>';} ?></td>
              <td><?php if(!empty($array['Expandingtwobrackets']['dateDue'])){echo $array['Expandingtwobrackets']['dateDue'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['PerimeterOfASemiCircle']['dateDue'])){echo $array['PerimeterOfASemiCircle']['dateDue'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['CompoundInterest']['dateDue'])){echo $array['CompoundInterest']['dateDue'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['ReversePercentages']['dateDue'])){echo $array['ReversePercentages']['dateDue'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['StandardForm']['dateDue'])){echo $array['StandardForm']['dateDue'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['RearrangingFormula']['dateDue'])){echo $array['RearrangingFormula']['dateDue'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['VolumeOfAPrism']['dateDue'])){echo $array['VolumeOfAPrism']['dateDue'];}else{echo'Not Started';} ?></td>
              <td><?php if(!empty($array['Trigonometry']['dateDue'])){echo $array['Trigonometry']['dateDue'];}else{echo'Not Started';} ?></td>
          </tr>
        </tbody>
        </table>
      </div>
    </div>
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
  <div class="col-sm-4">
    @foreach ($sDetails as $x)
        <div class="panel panel-default">
          <div class="panel-heading">Student Details</div>
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
  </div>
</div>
  @endforeach
</div>
@endsection
