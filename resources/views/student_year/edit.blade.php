@extends('layouts.backend')

@section('content')

<div class="panel panel-default">
  <div id="main-panel-head"  class="panel-heading">
    <center>
      <h1>Edit Student Year - {{$year->name}}</h1>
    </center>
  </div>
  <div id="main-panel-body" class="panel-body">
    <div class="row">
          <div class="col-md-4">
              <div class="panel panel-default">
                  <div class="panel-heading">Edit Student Year - {{$year->name}}</div>
                  <div class="panel-body">
                      <form class="form-horizontal" method="POST" action="/student_year/{{$year->id}}/edit">
                          {{ csrf_field() }}

                          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                              <label for="name" class="col-md-4 control-label">Year Name</label>
                              <div class="col-md-6">
                                  <input id="name" type="text" class="form-control" name="name" value="{{$year->name}}" required autofocus>
                                  @if ($errors->has('name'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('name') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group{{ $errors->has('unit_id') ? ' has-error' : '' }}">
                              <label for="unit_id" class="col-md-4 control-label">Unit Name</label>
                              <div class="col-md-6">
                                <select name="unit_id" class="form-control">
                                  @foreach($units as $unit)
                                  @if($year->unit->id == $unit->id)
                                   <option value="{{$unit->id}}" selected>{{$unit->name}}</option>
                                   @else
                                   <option value="{{$unit->id}}">{{$unit->name}}</option>
                                   @endif
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
                                  <input id="description" type="text" class="form-control" name="description" value="{{$year->description}}" required autofocus>
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
                                      Update Student Year
                                  </button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
          <div class="col-md-4">
            <div class="panel panel-default">
            <div class="panel-heading">Upload Students Via CSV</div>
            <div class="panel-body">
               @if($errors->any())
               <div class="alert alert-warning">
                 <strong>Warning! </strong>{{$errors->first()}}</a>.
               </div>
               @endif
              <form class="form-horizontal" method="POST" action="/student/create" enctype="multipart/form-data">
                  {{ csrf_field() }}
                                 <input type="hidden" name="year" value="{{$year->id}}">
                  <div class="form-group{{ $errors->has('student_id') ? ' has-error' : '' }}">
                      <label for="name" class="col-md-4 control-label">Append</label>
                      <div class="col-md-6">
                          <input type="radio" name="data" value="0" checked>
                      </div>
                  </div>
                  <div class="form-group{{ $errors->has('student_id') ? ' has-error' : '' }}">
                      <label for="name" class="col-md-4 control-label">Overwrite</label>
                      <div class="col-md-6">
                          <input type="radio" name="data" value="1">
                      </div>
                  </div>
                  <div class="form-group{{ $errors->has('students') ? ' has-error' : '' }}">
                     <label for="name" class="col-md-4 control-label">CSV File</label>
                      <div class="col-md-6">
                          <input id="students" type="file" name="students" value="{{ old('students') }}" required autofocus>
                          @if ($errors->has('students'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('students') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                  <center>
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                  </center>
              </form>
               <button data-toggle="collapse" data-target="#addstudent" class="btn btn-success">Manual Add</button>
               <div id="addstudent" class="collapse">
                 <form class="form-horizontal" method="POST" action="/student/create/student/">
                     {{ csrf_field() }}

                     <input type="hidden" name="year" value="{{$year->id}}">

                     <div class="form-group{{ $errors->has('student_id') ? ' has-error' : '' }}">
                         <label for="name" class="col-md-4 control-label">Student ID</label>
                         <div class="col-md-6">
                             <input id="student_id" type="text" class="form-control" name="student_id" value="{{ old('student_id') }}" required autofocus>
                             @if ($errors->has('student_id'))
                                 <span class="help-block">
                                     <strong>{{ $errors->first('student_id') }}</strong>
                                 </span>
                             @endif
                         </div>
                     </div>

                     <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                         <label for="firstname" class="col-md-4 control-label">Firstname</label>
                         <div class="col-md-6">
                             <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required autofocus>
                             @if ($errors->has('firstname'))
                                 <span class="help-block">
                                     <strong>{{ $errors->first('firstname') }}</strong>
                                 </span>
                             @endif
                         </div>
                     </div>

                     <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                         <label for="lastname" class="col-md-4 control-label">Lastname</label>
                         <div class="col-md-6">
                             <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus>
                             @if ($errors->has('lastname'))
                                 <span class="help-block">
                                     <strong>{{ $errors->first('lastname') }}</strong>
                                 </span>
                             @endif
                         </div>
                     </div>

                     <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                         <label for="dob" class="col-md-4 control-label">DOB</label>
                         <div class="col-md-6">
                             <input id="dob" type="text" class="form-control" name="dob" value="{{ old('dob') }}" required autofocus>
                             @if ($errors->has('dob'))
                                 <span class="help-block">
                                     <strong>{{ $errors->first('dob') }}</strong>
                                 </span>
                             @endif
                         </div>
                     </div>

                     <div class="form-group{{ $errors->has('tutor') ? ' has-error' : '' }}">
                         <label for="tutor" class="col-md-4 control-label">Tutor</label>
                         <div class="col-md-6">
                             <input id="tutor" type="text" class="form-control" name="tutor" value="{{ old('tutor') }}" required autofocus>
                             @if ($errors->has('tutor'))
                                 <span class="help-block">
                                     <strong>{{ $errors->first('tutor') }}</strong>
                                 </span>
                             @endif
                         </div>
                     </div>

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

                     <div class="form-group{{ $errors->has('course') ? ' has-error' : '' }}">
                         <label for="course" class="col-md-4 control-label">Course</label>
                         <div class="col-md-6">
                             <input id="course" type="text" class="form-control" name="course" value="{{ old('course') }}" required autofocus>
                             @if ($errors->has('course'))
                                 <span class="help-block">
                                     <strong>{{ $errors->first('course') }}</strong>
                                 </span>
                             @endif
                         </div>
                     </div>

                     <div class="form-group{{ $errors->has('maths_grade') ? ' has-error' : '' }}">
                         <label for="maths_grade" class="col-md-4 control-label">Maths Grade</label>
                         <div class="col-md-6">
                             <input id="maths_grade" type="text" class="form-control" name="maths_grade" value="{{ old('maths_grade') }}" required autofocus>
                             @if ($errors->has('maths_grade'))
                                 <span class="help-block">
                                     <strong>{{ $errors->first('maths_grade') }}</strong>
                                 </span>
                             @endif
                         </div>
                     </div>

                     <div class="form-group{{ $errors->has('withdrawn') ? ' has-error' : '' }}">
                         <label for="withdrawn" class="col-md-4 control-label">Withdrawn</label>
                         <div class="col-md-6">
                             <input id="withdrawn" type="text" class="form-control" name="withdrawn" value="{{ old('withdrawn') }}" required autofocus>
                             @if ($errors->has('withdrawn'))
                                 <span class="help-block">
                                     <strong>{{ $errors->first('withdrawn') }}</strong>
                                 </span>
                             @endif
                         </div>
                     </div>

                     <div class="form-group">
                         <div class="col-md-6 col-md-offset-4">
                             <button type="submit" class="btn btn-primary">
                                 Add Student
                             </button>
                         </div>
                     </div>
                 </form>
               </div>
            </div>
          </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-default">
         <div class="panel-heading">Student Results</div>
         <div class="panel-body">

           <div class="form-group">
               <label for="name" class="col-md-4 control-label">Reset Results</label>
               <div class="col-md-6">

                 <a href="/student_year/{{$year->id}}/results_rest"><button type="button" class="btn btn-danger">Reset</button></a>
               </div>
           </div>
           <br />
           <div class="form-group">
               <label for="name" class="col-md-4 control-label">Result CSV</label>
               <div class="col-md-6">

                 <a href="/studentsResults/csv"><button type="button" class="btn btn-danger">Export CSV</button></a>
               </div>
           </div>
         </div>
       </div>
      </div>
    </div>
   <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
       <div class="col-sm-8">
         <div class="page-header">
           <center>
             <h1>{{$year->name}} Student Data</h1>
           </center>
         </div>
       </div>
       <div class="col-sm-4">
         <input style="margin-top:30px" class="form-control" id="myInput" type="text" placeholder="Search..">
       </div>
      </div>
        <table class="table table-striped">
        <thead>
          <tr>
            <th>Student ID</th>
            <th>First Name</th>
            <th>Surname</th>
            <th>DOB</th>
            <th>Department</th>
            <th>Course</th>
            <th>GCSE Maths Grade</th>
            <th>Primary Tutor</th>
            <th>Withdrawn</th>
            <th>
              Edit
            </th>
            <th>
              <a href="/student/{{$year->id}}/deleteAll">Delete All</a>
            </th>
          </tr>
        </thead>
        <tbody id="myTable">
          @foreach ($data as $x)

          <tr>
            <td>{{$x->student_id}}</td>
            <td>{{$x->firstname}}</td>
            <td>{{$x->surname}}</td>
            <td>{{$x->dob}}</td>
            <td>{{$x->dept}}</td>
            <td>{{$x->course}}</td>
            <td>{{$x->gcse_maths_grade}}</td>
            <td>{{$x->primary_tutor}}</td>
            <td>{{$x->withdrawn}}</td>
            <td>
              @if($x->studentLogin->active)
                <a href="/student/{{$x->student_id}}/activate">Active</a>
              @else
                <a href="/student/{{$x->student_id}}/activate">Deactivated</a>
              @endif
            </td>
            <td>
              <a href="/student/{{$x->id}}/edit">Edit</a>
            </td>
            <td>
              <a data-toggle="tooltip" title="Delete" href="/student/{{$x->student_id}}/delete">
                <i style="font-size:20px" class="ion-ios-trash"></i>
              </a>
            </td>
          </tr>

          @endforeach
        </tbody>
      </table>
      {{ $data->links() }}
      </div>
      </div>
     </div>
@endsection
