@extends('layouts.backend')
@section('content')
<div class="row">
  <div class="col-sm-6 col-sm-offset-3">
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
</div>


@endsection
