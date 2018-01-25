@extends('layouts.backend')

@section('content')
<div class="row">
 <div class="col-sm-4"><ul class="list-group">
   <li class="list-group-item">Passed Students <span class="badge">{{$array['passed']}}</span></li>
   <li class="list-group-item">Total Compleated Students<span class="badge">{{$array['total']}}</span></li>
   <li class="list-group-item">Percentage Passed <span class="badge">{{$array['percentagePass']}}%</span></li>
 </ul>
</div>
 <div class="col-sm-4">
   <div class="page-header">
     <center>
       <h1>Department</h1>
     </center>
   </div>
 </div>
 <div class="col-sm-4"><ul class="list-group">
   <li class="list-group-item">Percentage Compleate <span class="badge">{{$array['percentageCom']}}%</span></li>
   <li class="list-group-item">Students still to compleate<span class="badge">{{$array['toCom']}}</span></li>
   <li class="list-group-item">Total number of students<span class="badge">{{$array['TotalResults']}}</span></li>
   <br />
   <input class="form-control" id="myInput" type="text" placeholder="Search..">
 </ul></div>
</div>

<form method="GET" action="/results/departments">
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
        <th>Department</th>
        <th>Percentage Passed</th>
        <th>Compleate</th>
        <th>Incompleate</th>
      </tr>
    </thead>
    <tbody id="myTable">
      @foreach ($data as $x)
      <tr>
        <td><a href="/results/{{$x['dept']}}/course">{{$x['dept']}}</a></td>
        <td>{{$x['pass']}}%</td>
        <td>{{$x['compleate']}}%</td>
        <td>{{$x['incompleate']}}%</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
</div>

</div>


@endsection
