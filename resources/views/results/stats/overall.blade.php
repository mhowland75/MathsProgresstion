@extends('layouts.backend')

@section('content')
<table class="table table-striped">
<thead>
  <tr>
    <th>Passed Students</th>
    <th>Total Students</th>
    <th>Percentage Passed</th>
    <th>Percentage Compleate</th>
    <th>Total Compleate</th>
    <th>Students still to compleate</th>
    <th>Total Results</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td>{{$array['passed']}}</td>
    <td>{{$array['total']}}</td>
    <td>{{$array['percentagePass']}}</td>
    <td>{{$array['percentageCom']}}</td>
    <td>{{$array['TotalCom']}}</td>
    <td>{{$array['toCom']}}</td>
    <td>{{$array['TotalResults']}}</td>
  </tr>
</tbody>
</table>
@endsection
