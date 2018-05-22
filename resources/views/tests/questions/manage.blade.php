@extends('layouts.backend')

@section('content')
<div class="page-header">
  <h1>{{$id->name}}</h1>
</div>
<div class="row">
 <div class="col-sm-7">
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
         <td><a data-toggle="tooltip" title="Manage Example" href="/test/{{$question->id}}/questions"><i style="font-size:20px" class="ion-ios-gear"></i></a></td>
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
 </div>
 <div class="col-sm-5">
       <div class="row">
           <div class="col-md-8 col-md-offset-2">
               <div class="panel panel-default">
                   <div class="panel-heading">Create question code</div>

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

                           <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
                               <label for="value" class="col-md-4 control-label">Value</label>
                               <div class="col-md-6">
                                   <input id="value" type="text" class="form-control" name="value" value="{{ old('value') }}" required autofocus>
                                   @if ($errors->has('value'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('value') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                               <label for="image" class="col-md-2 control-label">Image</label>
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
                                       Add Code
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
