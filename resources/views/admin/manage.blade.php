@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div id="main-panel-head"  class="panel-heading">
    <center>
      <h1>Administrator Management</h1>
    </center>
  </div>
  <div id="main-panel-body" class="panel-body">
    <div class="row">
     <div class="col-sm-6">
     <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default">
            <div class="panel-body">
            <div class="row">
              <div class="col-md-11 col-md-offset-1">
                <div class="row">
                <div class="col-sm-5">
                  <b><p>Email</p></b>
                </div>
                <div class="col-sm-1">
                  <b><p>Level</p></b>
                </div>
                <div class="col-sm-2">
                </div>
                <div class="col-sm-4">
                </div>
                </div>
              <form class="form-horizontal" method="POST" action='/admin/update'>
                  {{ csrf_field()}}

              @forelse ($data as $admin)
              <div class="row">
              <div class="col-sm-5">
                {{$admin['userinfo'][0]->email}}
              </div>
              <div class="col-sm-1">
                {{$admin['admininfo']->access_level}}
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                    <select name="{{$admin['admininfo']->id}}" class="form-control">
                      <option value="1" <?php if($admin['admininfo']->access_level == 1){echo'selected';}?>>1</option>
                      <option value="2" <?php if($admin['admininfo']->access_level == 2){echo'selected';}?>>2</option>
                      <option value="3" <?php if($admin['admininfo']->access_level == 3){echo'selected';}?>>3</option>
                    </select>
                </div>
              </div>
              <div class="col-sm-4">
                  <a href="/admin/delete/{{$admin['admininfo']->id}}"><center><i style="font-size:20px" class="ion-android-delete"></i></center></a>
              </div>
              </div>
                @empty
                    <p>No users</p>

                @endforelse
                <center><button  type="submit" class="btn btn-success">Update privileges</button></center>
            </form>
          </div>
        </div>
            </div>
          </div>
        </div>
        </div>
      </div>
     <div class="col-sm-6">
       <div class="row">

               <div class="panel panel-default">
                   <div class="panel-heading">Create New Administrator</div>

                   <div class="panel-body">
                       <form class="form-horizontal" method="POST" action="/admin/store">
                           {{ csrf_field() }}

                           <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                               <label for="name" class="col-md-4 control-label">Name</label>

                               <div class="col-md-6">
                                   <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                   @if ($errors->has('name'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('name') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                               <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                               <div class="col-md-6">
                                   <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required>

                                   @if ($errors->has('email'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('email') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group{{ $errors->has('job_title') ? ' has-error' : '' }}">
                               <label for="job_title" class="col-md-4 control-label">Job title</label>

                               <div class="col-md-6">
                                   <input id="job_title" type="text" class="form-control" name="job_title" value="{{ old('job_title') }}" required>

                                   @if ($errors->has('job_title'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('job_title') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group{{ $errors->has('access_level') ? ' has-error' : '' }}">
                               <label for="access_level" class="col-md-4 control-label">Access Level</label>

                               <div class="col-md-6">
                                   <select id="access_level" name="access_level" class="form-control">
                                     <option value="1">1</option>
                                     <option value="2" selected="selected">2</option>
                                   </select>
                                   @if ($errors->has('access_level'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('access_level') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                               <label for="password" class="col-md-4 control-label">Password</label>

                               <div class="col-md-6">
                                   <input id="password" type="password" class="form-control" name="password" required>

                                   @if ($errors->has('password'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('password') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                               <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                               <div class="col-md-6">
                                   <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                   @if ($errors->has('password_confirmation'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('password_confirmation') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group">
                               <div class="col-md-6 col-md-offset-4">
                                   <button type="submit" class="btn btn-primary">
                                       Register
                                   </button>
                               </div>
                           </div>
                       </form>
                   </div>
           </div>
       </div>
     </div>
    </div>
  </div>
</div>


@endsection
