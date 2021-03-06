@extends('layouts.backend')
@section('content')

<div class="panel panel-default">
  <div id="main-panel-head"  class="panel-heading">
    <center>
      <h1>{{$id->test->name}} - {!! $id->question !!}</h1>
    </center>
  </div>
  @if($errors->any())
    <div class="alert alert-warning">
      <strong>Warning!</strong> {{$errors->first()}}
    </div>
  @endif
  <div id="main-panel-body" class="panel-body">
    <ul class="breadcrumb" style="background-color:#FFFFFF">
      <li><a href="/unit/manage">Units</a></li>
      <li><a href="/test/{{$id->test->unit->id}}/manage">Unit - {{$id->test->unit->name}}</a></li>
      <li><a href="/test/{{$id->test->id}}/questions">Test - {{$id->test->name}}</a></li>
    </ul>
    <div class="row">
     <div class="col-sm-7">
       <div class="panel panel-default">
        <div class="panel-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Answer</th>
                <th>Right Answer</th>
              </tr>
            </thead>
            <tbody>
              @foreach($id->answers as $answer)
              <tr>
                <td>{{$answer->answers}}</td>
                <td>
                  @if($answer->right_answer)
                   <i style="font-size:20px" class="ion-checkmark-round"></i>
                  @else
                   <a data-toggle="tooltip" title="Set as Correct" href="/answer/{{$answer->id}}/correct">
                     <i style="font-size:20px" class="ion-close-round"></i>
                   </a>
                  @endif
                </td>
                <td><a data-toggle="tooltip" title="Edit" href="/answer/{{$answer->id}}/edit"><i style="font-size:20px" class="ion-edit"></i></a></td>
                  <td>
                    @if($answer->visibility)
                     <a data-toggle="tooltip" title="Visibility" href="/answer/{{$answer->id}}/visibility/">
                       <i style="font-size:20px" class="ion-eye"></i>
                     </a>
                    @else
                    <a data-toggle="tooltip" title="Visibility" href="/answer/{{$answer->id}}/visibility/">
                      <i style="font-size:20px" class="ion-eye-disabled"></i>
                    </a>
                    @endif
                  </td>
                  <td>
                    <a data-toggle="tooltip" title="Delete" href="/answer/{{$answer->id}}/delete">
                      <i style="font-size:20px" class="ion-ios-trash"></i>
                    </a>
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
     </div>
     <div class="col-sm-5">
       <div class="row">
           <div class="col-md-12">
               <div class="panel panel-default">
                   <div class="panel-heading">Create Question</div>
                   <div class="panel-body">
                       <form class="form-horizontal" method="POST" action="/answers/create">
                           {{ csrf_field() }}
                           <input type="hidden" value="{{$id->test_id}}" name="test_id" />
                           <input type="hidden" value="{{$id->id}}" name="question_id" />
                           <div class="form-group{{ $errors->has('answers') ? ' has-error' : '' }}">
                               <label for="answers" class="col-md-4 control-label">Answer</label>
                               <div class="col-md-6">
                                   <input id="answers" type="text" class="form-control" name="answers" value="{{ old('answers') }}" required autofocus>
                                   @if ($errors->has('answers'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('answers') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group{{ $errors->has('right_answers') ? ' has-error' : '' }}">
                               <label for="right_answers" class="col-md-4 control-label">Right Answer</label>
                               <div class="col-md-6">
                                 <select class="form-control" name="right_answers">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                  </select>
                                   @if ($errors->has('right_answers'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('right_answers') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group">
                               <div class="col-md-6 col-md-offset-4">
                                   <button type="submit" class="btn btn-primary">
                                       Add Answer
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
