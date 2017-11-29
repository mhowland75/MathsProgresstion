@extends('layouts.backend')

@section('content')
<div class="page-header">
  <div class="row">
   <div class="col-sm-8">
     <h1>Administrator Management</h1>
   </div>
   <div class="col-sm-4">
   </div>
  </div>
</div>
<div class="row">
 <div class="col-sm-6">

   <div class="panel panel-default">
     <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-8"><center><input style="margin:20px; width:80%;" class="form-control" id="myInput" type="text" placeholder="Search.."></center></div>
     </div>

     <div class="panel-body">
       <table  class="table table-striped">
       <thead>
         <tr>
           <th>Name</th>
           <th>Email</th>
           <th>Job Title</th>
         </tr>
       </thead>
       <tbody id="myTable">
         @foreach ($data as $x)
         <tr>
           <td style="width: 5%;">{{$x->name}}</td>
           <td>{{$x->email}}</td>
             <td>{{$x->job_title}}</td>
           <td><a data-toggle="tooltip" title="Edit" href="/admin/edit/{{$x->id}}"><i style="font-size:20px" class="ion-edit"></i></a></td>
           <td><a data-toggle="tooltip" title="Remove" href="/admin/{{$x->id}}/delete/user"><i style="font-size:20px" class="ion-android-delete"></i></a></td>
         </tr>
         @endforeach
       </tbody>
     </table>
     </div>
   </div>
 </div>
 <div class="col-sm-6">
   <div class="row">

           <div class="panel panel-default">
               <div class="panel-heading">Register</div>

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

@endsection
