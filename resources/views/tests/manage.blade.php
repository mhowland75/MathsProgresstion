@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div id="main-panel-head"  class="panel-heading">
    <center>
      <h1>{{$unit_id->name}} - Tests</h1>
    </center>
  </div>
  @if($errors->any())
    <div class="alert alert-warning">
      <strong>Warning!</strong> {{$errors->first()}}
    </div>
  @endif
  <div id="main-panel-body" class="panel-body">
    <ul style="background-color:#FFFFFF" class="breadcrumb">
      <li><a href="/unit/manage">Units</a></li>
    </ul>
    <div class="row">
     <div class="col-sm-7">

           @foreach($array as $key => $sub)
           <div class="row">
             <div class="col-sm-12">
               <div class="panel panel-default">
                <div class="panel-heading">
                  {{$key}}
                </div>
                <div class="panel-body">
                  <table class="table table-striped">
                      @if(count($sub))
                        <thead>
                          <tr>
                            <th>Test Name</th>
                            <th>No. of Questions</th>
                            <th>Passmark</th>
                          </tr>
                        </thead>
                        <tbody>
                      @endif
                      @forelse($sub as $test)
                      <tr>
                        <td><a href="/test/{{$test->id}}/questions">{{$test->name}}</a></td>
                        <td>{{$test->questions->count()}}</td>
                        <td>{{$test->passmark}}</td>
                        <td><a data-toggle="tooltip" title="Edit" href="/test/{{$test->id}}/edit"><i style="font-size:20px" class="ion-edit"></i></a></td>
                        <td>
                          @if($test->visibility)
                           <a data-toggle="tooltip" title="Visibility" href="/test/{{$test->id}}/visibility/">
                             <i style="font-size:20px" class="ion-eye"></i>
                           </a>
                          @else
                          <a data-toggle="tooltip" title="Visibility" href="/test/{{$test->id}}/visibility/">
                            <i style="font-size:20px" class="ion-eye-disabled"></i>
                          </a>
                          @endif
                        </td>
                        <td>
                          <a data-toggle="tooltip" title="Delete" href="/test/{{$test->id}}/delete">
                            <i style="font-size:20px" class="ion-ios-trash"></i>
                          </a>
                        </td>
                      </tr>
                      @empty
                         <p>
                           There are no test.
                         </p>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
           @endforeach
    </div>
     <div class="col-sm-5">
           <div class="col-md-12">
               <div class="panel panel-default">
                   <div class="panel-heading">Create Test</div>
                   <div class="panel-body">
                       <form class="form-horizontal" method="POST" action="/test/create/test">
                           {{ csrf_field() }}
                           <input type="hidden" name="unit_id" value="{{$unit_id->id}}">
                           <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                               <label for="name" class="col-md-4 control-label">Test Name</label>
                               <div class="col-md-6">
                                   <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                   @if ($errors->has('name'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('name') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                               <label for="department" class="col-md-4 control-label">Subjects</label>
                               <div class="col-md-6">
                                 <select  class="form-control" name="subject_id">
                                   @foreach($subjects as $subject)
                                    <option value="{{$subject->id}}">{{$subject->subject}}</option>
                                   @endforeach
                                  </select>
                                   @if ($errors->has('department'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('department') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group{{ $errors->has('passmark') ? ' has-error' : '' }}">
                               <label for="passmark" class="col-md-4 control-label">Passmark</label>
                               <div class="col-md-6">
                                   <input id="passmark" type="text" class="form-control" name="passmark" value="{{ old('passmark') }}" required autofocus>
                                   @if ($errors->has('passmark'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('passmark') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group">
                               <div class="col-md-6 col-md-offset-4">
                                   <button type="submit" class="btn btn-primary">
                                       Create Test
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


@endsection
