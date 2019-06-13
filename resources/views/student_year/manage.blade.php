@extends('layouts.backend')
@section('content')

<div class="panel panel-default">
  <div id="main-panel-head"  class="panel-heading">
    <center>
      <h1>Student Groups</h1>
    </center>
  </div>
  <div id="main-panel-body" class="panel-body">
    <div class="row">
     <div class="col-sm-7">
       <div class="panel panel-default">
      <div class="panel-body">
        @if(isset($years[0]->id))
          <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Groups</th>
                    <th>No. of Students</th>
                    <th>Associated Unit</th>
                    <th>Active</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($years as $year)
                <tr>
                  <td><a href="/student_year/{{$year->id}}/edit">{{$year->name}}</a></td>
                  <td><a href="/student/{{$year->id}}/index">{{$year->students->count()}}</a></td>
                  <td>
                  @if(!empty($year->unit->id))
                    <a href="/test/{{$year->unit->id}}/manage">{{$year->unit->name}}</a>
                  @else
                    <p>
                      No Associated Unit
                    </p>
                  @endif
                  </td>
                  <td><a href="/student_year/{{$year->id}}/activate">
                    @if($year->student_login_active)
                      <i style="font-size:20px" class="ion-toggle-filled"></i>
                    @else
                      <i style="font-size:20px" class="ion-toggle"></i>
                    @endif
                  </a></td>
                  <td>
                    <a data-toggle="tooltip" title="Edit" href="/student_year/{{$year->id}}/edit">
                      <i style="font-size:20px" class="ion-edit"></i>
                    </a>
                  </td>
                  <td>
                    <a data-toggle="tooltip" title="Delete" href="/student_year/{{$year->id}}/delete">
                      <i style="font-size:20px" class="ion-ios-trash"></i>
                    </a>
                  </td>
                  <td>
                    <a data-toggle="tooltip" title="Results" href="/results/index/{{$year->id}}">
                      <i style="font-size:20px" class="ion-ios-book"></i>
                    </a>
                  </td>
                </tr>
                @empty
                @endforelse

            </tbody>
          </table>
        @else
          <div class="alert alert-info">
              <strong>Info!</strong> There are currently no student set.
          </div>
        @endif
      </div>
      </div>
     </div>
     <div class="col-sm-5">
       <div class="row">
           <div class="col-md-12">
               <div class="panel panel-default">
                   <div class="panel-heading"><p>
                     Create Student Group
                   </p></div>
                   <div class="panel-body">
                   @if(isset($units[0]->id))
                   <form class="form-horizontal" method="POST" action="/student_year/create">
                           {{ csrf_field() }}

                           <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                               <label for="name" class="col-md-4 control-label">Year Name</label>
                               <div class="col-md-6">
                                   <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                   @if ($errors->has('name'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('name') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group{{ $errors->has('unit_id') ? ' has-error' : '' }}">
                               <label for="unit_id" class="col-md-4 control-label">Associated Unit</label>
                               <div class="col-md-6">
                                 <select name="unit_id" class="form-control">
                                   @foreach($units as $unit)
                                    <option value="{{$unit->id}}">{{$unit->name}}</option>
                                   @endforeach
                                  </select>
                                   @if ($errors->has('unit_id'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('unit_id') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                               <label for="description" class="col-md-4 control-label">Year description</label>
                               <div class="col-md-6">
                                   <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autofocus>
                                   @if ($errors->has('description'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('description') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group">
                               <div class="col-md-6 col-md-offset-4">
                                   <button type="submit" class="btn btn-primary">
                                       Create Student Year
                                   </button>
                               </div>
                           </div>
                       </form>
                    @else
                      <div class="alert alert-warning">
                        <strong>Warning!</strong> There are currently no units. You will need to create a unit before creating a new student set.
                      </div>
                   @endif
                   </div>
               </div>
           </div>
       </div>
     </div>
    </div>
  </div>
</div>

@endsection
