@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create department code</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/departments/store">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            <label for="department" class="col-md-4 control-label">Department</label>
                            <div class="col-md-6">
                                <input id="department" type="text" class="form-control" name="department" value="{{ old('department') }}" required autofocus>
                                @if ($errors->has('department'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('group_code') ? ' has-error' : '' }}">
                            <label for="group_code" class="col-md-4 control-label">Group Code</label>
                            <div class="col-md-6">
                                <input id="group_code" type="text" class="form-control" name="group_code" value="{{ old('group_code') }}" required autofocus>
                                @if ($errors->has('group_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('group_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('course_name') ? ' has-error' : '' }}">
                            <label for="course_name" class="col-md-4 control-label">Course Name</label>
                            <div class="col-md-6">
                                <input id="course_name" type="text" class="form-control" name="course_name" value="{{ old('course_name') }}" required autofocus>
                                @if ($errors->has('course_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
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
