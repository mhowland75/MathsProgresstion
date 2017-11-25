@extends('layouts.backend')
@section('content')
<div class="row">
 <div class="col-sm-8">
   <div class="page-header">
     <h1>Department codes</h1>
   </div>
   <div class="panel panel-default">
     <div class="panel-body">
       <input class="form-control" id="myInput" type="text" placeholder="Search..">
       <table class="table table-striped">
         <thead>
           <tr>
             <th>Course Name</th>
             <th>Dpartment</th>
             <th>Group Code</th>
             <th>Created By</th>
             <th>Updated By</th>
           </tr>
         </thead>
         <tbody id="myTable">
       @forelse ($departments as $department)
       <tr>
         <td>{{ $department->course_name }}</td>
         <td>{{ $department->department }}</td>
         <td>{{ $department->group_code }}</td>
         <td>{{ $department->created_by }}</td>
         <td>{{ $department->updated_by }}</td>
         <td><a data-toggle="tooltip" title="Edit code" href="/departments/{{$department->id}}/edit"><i style="font-size:20px" class="ion-edit"></i></a></td>
         <td><a data-toggle="tooltip" title="Remove code" href="/departments/{{$department->id}}/delete"><i style="font-size:20px" class="ion-android-delete"></i></a></td>
       </tr>
       @empty
           <p>No users</p>
       @endforelse
       </tbody>
       </table>
     </div>
   </div>
 </div>
 <div class="col-sm-4">
   <div class="page-header">
     <h1>Add Code</h1>
   </div>

   <div class="panel panel-default">
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

@endsection
