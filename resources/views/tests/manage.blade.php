@extends('layouts.backend')

@section('content')
<div class="page-header">
  <h1>Tests</h1>
</div>
<div class="row">
 <div class="col-sm-7">
   <table class="table table-striped">
       @if(!empty($tests))
         <thead>
           <tr>
             <th>Test Name</th>
             <th>No. of Questions</th>
             <th>Passmark</th>
           </tr>
         </thead>
         <tbody>
       @endif
       @forelse($tests as $test)
       <tr>
         <td><a href="/test/{{$test->id}}/questions">{{$test->name}}</a></td>
         <td>{{$test->questions->count()}}</td>
         <td>{{$test->passmark}}</td>
         <td><a data-toggle="tooltip" title="Manage Example" href="/test/{{$test->id}}/questions"><i style="font-size:20px" class="ion-ios-gear"></i></a></td>
         <td><a data-toggle="tooltip" title="Edit" href="/education/{{$test->id}}/edit"><i style="font-size:20px" class="ion-edit"></i></a></td>
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
 <div class="col-sm-5">
   <div class="row">
       <div class="col-md-8 col-md-offset-2">
           <div class="panel panel-default">
               <div class="panel-heading">Create Test</div>

               <div class="panel-body">
                   <form class="form-horizontal" method="POST" action="/test/create">
                       {{ csrf_field() }}

                       <input type="hidden" name="unit_id" value="{{$unit_id}}">

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

                       <div class="form-group{{ $errors->has('right_answers') ? ' has-error' : '' }}">
                           <label for="right_answers" class="col-md-4 control-label">Department</label>
                           <div class="col-md-6">
                             <select name="right_answers">
                                <option value="maths">Maths</option>
                                <option value="english">English</option>
                              </select>
                               @if ($errors->has('right_answers'))
                                   <span class="help-block">
                                       <strong>{{ $errors->first('right_answers') }}</strong>
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
