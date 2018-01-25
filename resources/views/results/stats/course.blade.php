@extends('layouts.backend')

@section('content')
<div class="row">
 <div class="col-sm-8">
   <div class="page-header">
     <center>
       <h1>Courses for {{$dept}}</h1>
     </center>
   </div>
 </div>
 <div class="col-sm-4">
   <input style="margin-top:30px" class="form-control" id="myInput" type="text" placeholder="Search..">
 </div>
</div>
<a href="/results/departments">Back to Depratments</a>
<form method="GET" action="/results/{{$dept}}/course">
  {{ csrf_field() }}
 <select name="sort" onchange="this.form.submit()">
   <option value="pl" <?php if($sort == "pl"){echo'selected';} ?>>Percentage Low - High</option>
   <option value="ph" <?php if($sort == "ph"){echo'selected';} ?>>Percentage High - Low</option>
   <option value="cl" <?php if($sort == "cl"){echo'selected';} ?>>Compleated Low - High</option>
   <option value="ch" <?php if($sort == "ch"){echo'selected';} ?>>Compleated High - Low</option>
 </select>
</form>
<div class="panel-body">
  <div class="panel panel-default">
  <div class="panel-body">
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Courses</th>
        <th>Percentage Passed</th>
        <th>Compleate</th>
        <th>Incompleate</th>
      </tr>
    </thead>
    <tbody id="myTable">
      @foreach ($data as $x=>$y)
      <tr>
        <td><a href="/results/{{$x}}/student">{{$y['classname']}}</a></td>
        <td>{{$y['percentPass']}}%</td>
        <td>{{$y['studentsComplete']}}%</td>
        <td>{{$y['studentsIncomplete']}}%</td>
      @endforeach
    </tbody>
  </table>
  </div>
</div>

</div>

@endsection
