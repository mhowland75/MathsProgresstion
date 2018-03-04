@extends('layouts.backend')
@section('content')
<div class="row">
  <div class="col-sm-3">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>IP Address</th>
          <th>Date/Time</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $x)
        <tr>
          <td>{{$x->ip_address}}</td>
          <td>{{$x->created_at}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $data->links() }}
  </div>
  <div class="col-sm-9">
      <div id="line_top_x"></div>
  </div>
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
        width: 900,
        height: 500,
      };

      var chart = new google.charts.Line(document.getElementById('line_top_x'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
  </script>

@endsection
