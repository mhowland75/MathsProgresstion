@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                  <div class="list-group">
                   <a href="/departments/index" class="list-group-item">Department Management</a>
                   <a href="/education/manage" class="list-group-item">Education Management</a>
                   <a href="/teachers/manage" class="list-group-item">Teacher Management</a>
                   <a href="/admin/register" class="list-group-item">Add Admin</a>
                   <a href="/admin/manageAccess" class="list-group-item">Admin Privileges</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
