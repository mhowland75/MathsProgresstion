@extends('layouts.backend')

@section('content')
<div class="page-header">
  <center>
    <h1>Add Results Data</h1>
  </center>
</div>
<div class="row">
 <div class="col-sm-6 col-sm-offset-3">
   <div class="panel panel-default">
  <div class="panel-heading">Upload Data</div>
  <div class="panel-body">
    <form class="form-horizontal" method="POST" action="/results/store" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-sm-6 col-sm-offset-3">
          <center>
            <input type="radio" name="data" value="0" checked> Append<br>
            <input type="radio" name="data" value="1"> Overwrite<br><br />
          </center>
          <div class="form-group{{ $errors->has('results') ? ' has-error' : '' }}">
                  <input id="results" type="file" name="results" value="{{ old('results') }}" required autofocus>
                  @if ($errors->has('results'))
                      <span class="help-block">
                          <strong>{{ $errors->first('results') }}</strong>
                      </span>
                  @endif
              </div>
              <center>
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
              </center>

          </div>

    </form>
  </div>
</div>
 </div>
</div>



@endsection
