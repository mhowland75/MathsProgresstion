@extends('layouts.backend')

@section('content')
<div class="page-header">
  <center>
    <h1>Edit {{$data->firstname}} {{$data->surname}} Details</h1>
  </center>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading">Edit </div>
        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="/student/update">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$data->id}}" />
                <div class="form-group{{ $errors->has('student_id') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Student ID</label>
                    <div class="col-md-6">
                        <input id="student_id" type="text" class="form-control" name="student_id" value="{{$data->student_id}}" required autofocus>
                        @if ($errors->has('student_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('student_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                    <label for="firstname" class="col-md-4 control-label">firstname</label>
                    <div class="col-md-6">
                        <input id="firstname" type="text" class="form-control" name="firstname" value="{{$data->firstname}}" required autofocus>
                        @if ($errors->has('firstname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('firstname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                    <label for="lastname" class="col-md-4 control-label">lastname</label>
                    <div class="col-md-6">
                        <input id="lastname" type="text" class="form-control" name="lastname" value="{{$data->surname}}" required autofocus>
                        @if ($errors->has('lastname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('lastname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                    <label for="dob" class="col-md-4 control-label">dob</label>
                    <div class="col-md-6">
                        <input id="dob" type="text" class="form-control" name="dob" value="{{$data->dob}}" required autofocus>
                        @if ($errors->has('dob'))
                            <span class="help-block">
                                <strong>{{ $errors->first('dob') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('tutor') ? ' has-error' : '' }}">
                    <label for="tutor" class="col-md-4 control-label">tutor</label>
                    <div class="col-md-6">
                        <input id="tutor" type="text" class="form-control" name="tutor" value="{{$data->primary_tutor}}" required autofocus>
                        @if ($errors->has('tutor'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tutor') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                    <label for="department" class="col-md-4 control-label">department</label>
                    <div class="col-md-6">
                        <input id="department" type="text" class="form-control" name="department" value="{{$data->dept}}" required autofocus>
                        @if ($errors->has('department'))
                            <span class="help-block">
                                <strong>{{ $errors->first('department') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('course') ? ' has-error' : '' }}">
                    <label for="course" class="col-md-4 control-label">course</label>
                    <div class="col-md-6">
                        <input id="course" type="text" class="form-control" name="course" value="{{$data->course}}" required autofocus>
                        @if ($errors->has('course'))
                            <span class="help-block">
                                <strong>{{ $errors->first('course') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('maths_grade') ? ' has-error' : '' }}">
                    <label for="maths_grade" class="col-md-4 control-label">maths_grade</label>
                    <div class="col-md-6">
                        <input id="maths_grade" type="text" class="form-control" name="maths_grade" value="{{$data->gcse_maths_grade}}" required autofocus>
                        @if ($errors->has('maths_grade'))
                            <span class="help-block">
                                <strong>{{ $errors->first('maths_grade') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('withdrawn') ? ' has-error' : '' }}">
                    <label for="withdrawn" class="col-md-4 control-label">Withdrawn</label>
                    <div class="col-md-6">
                        <input id="withdrawn" type="text" class="form-control" name="withdrawn" value="{{$data->withdrawn}}" required autofocus>
                        @if ($errors->has('withdrawn'))
                            <span class="help-block">
                                <strong>{{ $errors->first('withdrawn') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Save Student
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>


@endsection
