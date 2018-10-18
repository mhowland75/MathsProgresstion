@extends('layouts.backend')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Create department code</div>

            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="/subject/edit">
                    {{ csrf_field() }}

                     <input type="hidden" name="subject_id" value="{{$subject_id->id}}">

                    <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                        <label for="subject" class="col-md-4 control-label">Subject</label>
                        <div class="col-md-6">
                            <input id="subject" type="text" class="form-control" name="subject" value="{{ $subject_id->subject }}" required autofocus>
                            @if ($errors->has('subject'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Add Subject
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
