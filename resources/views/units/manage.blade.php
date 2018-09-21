@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div id="main-panel-head"  class="panel-heading">
    <center>
      <h1>Units</h1>
    </center>
  </div>
  <div id="main-panel-body" class="panel-body">
    <ul style="background-color:#FFFFFF" class="breadcrumb">
      <li><a href="/unit/manage">Units</a></li>
    </ul>
    <div class="panel-body">
      <div class="row">
       <div class="col-sm-7">
        <div class="panel panel-default">
          <div class="panel-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Unit Name</th>
                  <th>No. of Tests</th>
                  <th>Student Sets</th>
                  <th>Active Status</th>
                </tr>
              </thead>
              <tbody>
                @if(!empty($units))
                @endif
                @forelse($units as $unit)
                <tr>
                  <td><a href="/test/{{$unit->id}}/manage">{{$unit->name}}</a></td>
                  <td>{{$unit->tests->count()}}</td>
                  <td>
                    @foreach($unit->studentsYears as $name)
                     <a href="/student_year/{{$name->id}}/index">{{$name->name}}</a><br />
                    @endforeach
                  </td>
                  <td>
                    @if($unit->status)
                    <p style="color:green">
                      Active
                    </p>
                    @else
                    <p style="color:red">
                      Inactive
                    </p>
                    @endif
                  </td>
                  <td>
                    <a data-toggle="tooltip" title="Delete" href="/unit/{{$unit->id}}/delete">
                      <i style="font-size:20px" class="ion-ios-trash"></i>
                    </a>
                  </td>
                </tr>
                @empty
                   <p>
                     There are no unit.
                   </p>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
       </div>
       <div class="col-sm-5">
         <div class="row">
             <div class="col-md-12">
                 <div class="panel panel-default">
                     <div class="panel-body">
                         <form class="form-horizontal" method="POST" action="/unit/create">
                             {{ csrf_field() }}
                             <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                 <label for="name" class="col-md-4 control-label">Unit Name</label>
                                 <div class="col-md-6">
                                     <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                     @if ($errors->has('name'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('name') }}</strong>
                                         </span>
                                     @endif
                                 </div>
                             </div>
                             <div class="form-group">
                                 <div class="col-md-6 col-md-offset-4">
                                     <button type="submit" class="btn btn-primary">
                                         Create unit
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
</div>
@endsection
