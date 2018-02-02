@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Pass Mark</div>
                <div class="panel-body">
                  <center>
                    <h3>Current Pass Mark: {{$passMark}}</h3>
                  </center>
                  <br />
                    <form class="form-horizontal" method="POST" action="/results/storePassMark">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('passMark') ? ' has-error' : '' }}">
                            <label for="passMark" class="col-md-4 control-label">Pass Mark</label>
                            <div class="col-md-6">
                                <input id="passMark" type="text" class="form-control" name="passMark" value="{{ old('passMark') }}" required autofocus>
                                @if ($errors->has('passMark'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('passMark') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
