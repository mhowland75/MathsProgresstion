@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create queston code</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/queston/create">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('answers') ? ' has-error' : '' }}">
                            <label for="answers" class="col-md-4 control-label">answers</label>
                            <div class="col-md-6">
                                <input id="answers" type="text" class="form-control" name="answers" value="{{ old('answers') }}" required autofocus>
                                @if ($errors->has('answers'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answers') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('right_answers') ? ' has-error' : '' }}">
                            <label for="right_answers" class="col-md-4 control-label">right_answers</label>
                            <div class="col-md-6">
                                <input id="right_answers" type="text" class="form-control" name="right_answers" value="{{ old('right_answers') }}" required autofocus>
                                @if ($errors->has('right_answers'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('right_answers') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Code
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
