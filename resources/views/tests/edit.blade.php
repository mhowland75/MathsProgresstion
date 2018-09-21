@extends('layouts.backend')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$test->name}}</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/test/{{$test->id}}/update">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$test->name}}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            <label for="department" class="col-md-4 control-label">Department</label>
                            <div class="col-md-6">
                              <select class="form-control" name="subject_id">
                                @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}"<?php if($test->subject_id == $subject->subject){echo'selected';} ?>>{{$subject->subject}}</option>
                                @endforeach
                               </select>
                                @if ($errors->has('department'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('passmark') ? ' has-error' : '' }}">
                            <label for="passmark" class="col-md-4 control-label">Passmark</label>
                            <div class="col-md-6">
                                <input id="passmark" type="text" class="form-control" name="passmark" value="{{$test->passmark}}" required autofocus>
                                @if ($errors->has('passmark'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('passmark') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Test
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
