@extends('layouts.backend')

@section('content')
<div class="page-header">
  <center>
    <h1>Add Student Data</h1>
  </center>
</div>
<div class="row">
 <div class="col-sm-6 col-sm-offset-3">
   <div class="panel panel-default">
  <div class="panel-heading">Upload Data</div>
  <div class="panel-body">
    <form class="form-horizontal" method="POST" action="/student/store" enctype="multipart/form-data">
        {{ csrf_field() }}
        <center>
          <input type="radio" name="data" value="0" checked> Append<br>
          <input type="radio" name="data" value="1"> Overwight<br><br />
        </center>
        <div class="form-group{{ $errors->has('students') ? ' has-error' : '' }}">
            <div class="col-md-6 col-sm-offset-3">
                <input id="students" type="file" name="students" value="{{ old('students') }}" required autofocus>
                @if ($errors->has('students'))
                    <span class="help-block">
                        <strong>{{ $errors->first('students') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <center>
          <button type="submit" class="btn btn-primary">
              Submit
          </button>
        </center>
    </form>
  </div>
</div>
 </div>
</div>



@endsection
