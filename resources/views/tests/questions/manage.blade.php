@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div style="background-color:#d0d3d4"  class="panel-heading">
    <center>
      <h1>{{$id->name}}</h1>
    </center>
    @if($errors->any())
    <div class="alert alert-warning">
      <h4>{{$errors->first()}}</h4>
    </div>
    @endif
  </div>
  <div style="background-color:#F5F5F5" class="panel-body">
    <ul style="background-color:#FFFFFF" class="breadcrumb">
      <li><a href="/unit/manage">Units</a></li>
      <li><a href="/test/{{$id->unit->id}}/manage">Unit - {{$id->unit->name}}</a></li>
    </ul>
    <div class="row">
     <div class="col-sm-7">
       <div class="panel panel-default">
        <div class="panel-body">
          @if(count($id->questions))
            <table class="table table-striped">
            <thead>
              <tr>
                <th>Question</th>
                <th>Image</th>
                <th>No. of Answers</th>
              </tr>
            </thead>
            <tbody>
              @foreach($id->questions as $question)
              <tr>
                <td><a href="/questions/{{$question->id}}/answers">{{$question->question}}</a></td>
                <td>
                  @if($question->image)
                   <img style="max-width:200px; min-width:100px"  class="img-thumbnail" src='{{$question->image}}'/>
                  @endif
                </td>
                <td>{{$question->answers->count()}}</td>
                <td><a data-toggle="tooltip" title="Edit" href="/question/{{$question->id}}/edit"><i style="font-size:20px" class="ion-edit"></i></a></td>
                <td>
                  @if($question->visibility)
                   <a data-toggle="tooltip" title="Visibility" href="/question/{{$question->id}}/visibility/">
                     <i style="font-size:20px" class="ion-eye"></i>
                   </a>
                  @else
                  <a data-toggle="tooltip" title="Visibility" href="/question/{{$question->id}}/visibility/">
                    <i style="font-size:20px" class="ion-eye-disabled"></i>
                  </a>
                  @endif
                </td>
                <td>
                  <a data-toggle="tooltip" title="Delete" href="/questions/{{$question->id}}/delete">
                    <i style="font-size:20px" class="ion-ios-trash"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @else
            <p>
              No Questions
            </p>
          @endif
        </div>
      </div>
     </div>
     <div class="col-sm-5">
           <div class="row">
               <div class="col-md-8 col-md-offset-2">
                   <div class="panel panel-default">
                       <div class="panel-heading">Create Questions</div>

                       <div class="panel-body">
                           <form class="form-horizontal" method="POST" action="/question/create" enctype="multipart/form-data">
                               {{ csrf_field() }}

                               <input type="hidden" name="test_id" value="{{$id->id}}">

                               <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                                   <label for="question" class="col-md-4 control-label">Question</label>
                                   <div class="col-md-6">
                                       <input id="question" type="text" class="form-control" name="question" value="{{ old('question') }}" required autofocus>
                                       @if ($errors->has('question'))
                                           <span class="help-block">
                                               <strong>{{ $errors->first('question') }}</strong>
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
                                           Add Question
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
