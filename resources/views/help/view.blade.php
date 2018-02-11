@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/help/store">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-2 control-label">Name</label>
                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-2 control-label">Email</label>
                            <div class="col-md-10">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                            <label for="subject" class="col-md-2 control-label">Subject</label>
                            <div class="col-md-10">
                                <input id="subject" type="text" class="form-control" name="subject" value="{{ old('subject') }}" required autofocus>
                                @if ($errors->has('subject'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <label for="message" class="col-xs-12 col-sm-2 col-md-2 control-label">Message</label>
                            <div class="col-xs-12 col-sm-10 col-md-10">
                                <textarea style="height:300px; width:95%" id="message" type="text" class="form-control" name="message">{{ old('message') }}</textarea>
                                @if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-4 col-md-4">
          <img id="helpImage" class="img-rounded" src="/images/help.png" />
        </div>
    </div>
    <hr />
    <br />
    <p style="text-align:center; font-size: 150%; font-weight: 400; line-height: 35px;">
      If you have any issues either complete the contact form above or speak to one of the team pictured at the bottom of the page. Members of the team can be found in M302 at CCC or at the back of the library at SVC.
    </p>
    <br />
    <hr />
<div class="page-header">
  <center>
    <h1>Staff</h1>
  </center>
</div>
<div class="row">
  @foreach ($data as $x)
    <div class="col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-0 col-md-3 col-md-offset-0">
      <div style="height:350px" class="panel panel-default">
        <div style="height:250px" class="panel-body">
          <div  style="text-align: center;">
            <img style="width:inherit; height:inherit;" class="img-thumbnail" src='{{$x->image}}'/>
          </div>

        </div>
        <div style="height:100px; background-color:#0093A8" class="panel-footer"><center><h4 style="color:white">{{$x->name}}</h4><br /><p style="color:white">{{$x->job_title}}</p></center></div>
      </div>
    </div>
@endforeach
</div>

@endsection
