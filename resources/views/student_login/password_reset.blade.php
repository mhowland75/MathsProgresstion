@extends('layouts.app')

@section('content')
    <div class="row">
        <div style="margin-top:100px;" class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/student/password_reset">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                            <label for="new_password" class="col-md-4 control-label">Student ID</label>

                            <div class="col-md-6">
                                <input id="new_password" type="new_password" class="form-control" name="new_password" value="{{ old('new_password') }}" required autofocus>

                                @if ($errors->has('new_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="con_con_password" class="col-md-4 control-label">con_password</label>

                            <div class="col-md-6">
                                <input id="con_password" type="con_password" class="form-control" name="con_password" required>

                                @if ($errors->has('con_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('con_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
