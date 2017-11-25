@extends('layouts.backend')

@section('content')
<div class="page-header">
  <h1>Manage Staff</h1>
</div>
<div class="row">
 <div class="col-sm-6">
   <div class="panel panel-default">
     <div class="panel-body">
       <table class="table table-striped">
       <thead>
         <tr>
           <th>Image</th>
           <th>Name</th>
           <th>Job title</th>
         </tr>
       </thead>
       <tbody>
         @foreach ($data as $x)
         <tr>
           <td><img class="img-thumbnail" src='{{$x->image}}'/></td>
           <td>{{$x->name}}</td>
           <td>{{$x->job_title}}</td>
           <td><a data-toggle="tooltip" title="Edit" href="/teachers/{{$x->id}}/edit"><i style="font-size:20px" class="ion-edit"></i></a></td>
           <td><a data-toggle="tooltip" title="Remove" href="/teachers/{{$x->id}}/delete"><i style="font-size:20px" class="ion-android-delete"></i></a></td>
         </tr>
         @endforeach
       </tbody>
     </table>
     </div>
   </div>
 </div>
 <div class="col-sm-6">
   <div class="panel panel-default">
       <div class="panel-heading">Create New Staff Member</div>
       <div class="panel-body">
           <form class="form-horizontal" method="POST" action="/teachers/store" enctype="multipart/form-data">
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

               <div class="form-group{{ $errors->has('job_title') ? ' has-error' : '' }}">
                   <label for="job_title" class="col-md-4 control-label">Job Title</label>
                   <div class="col-md-6">
                       <input id="job_title" type="text" class="form-control" name="job_title" value="{{ old('job_title') }}" required autofocus>
                       @if ($errors->has('job_title'))
                           <span class="help-block">
                               <strong>{{ $errors->first('job_title') }}</strong>
                           </span>
                       @endif
                   </div>
               </div>

               <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                   <label for="image" class="col-md-4 control-label">Image</label>
                   <div class="col-md-6">
                       <input id="image" type="file" name="image" value="{{ old('image') }}">
                       @if ($errors->has('image'))
                           <span class="help-block">
                               <strong>{{ $errors->first('image') }}</strong>
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




@endsection
