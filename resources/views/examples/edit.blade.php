@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div id="main-panel-head"  class="panel-heading">
    <center>
      <h1>{{$education->name}} - {{$data->name}} example</h1>
    </center>
  </div>
  <div id="main-panel-body" class="panel-body">
    <form class="form-horizontal" method="POST" action="/examples/update" enctype="multipart/form-data">
      {{ csrf_field() }}
        <input type="hidden" name="education_id" value="{{$education->id}}"/>
          <input type="hidden" name="id" value="{{$data->id}}"/>
    <div class="row">
     <div class="col-sm-6">
       <div class="panel panel-default">
         <div class="panel-body">
           <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
               <label for="name" class="col-md-2 control-label">Name</label>
               <div class="col-md-10">
                   <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}" required autofocus>
                   @if ($errors->has('name'))
                       <span class="help-block">
                           <strong>{{ $errors->first('name') }}</strong>
                       </span>
                   @endif
               </div>
           </div>

           <div class="form-group{{ $errors->has('introduction') ? ' has-error' : '' }}">
               <label for="introduction" class="col-md-2 control-label">Introduction</label>
               <div class="col-md-10">
                  <textarea id="introduction" type="text" class="form-control" name="introduction">{!! $data->introduction !!}</textarea>
                   @if ($errors->has('introduction'))
                       <span class="help-block">
                           <strong>{{ $errors->first('introduction') }}</strong>
                       </span>
                   @endif
               </div>
           </div>

           <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
               <label for="question" class="col-md-2 control-label">Question</label>
               <div class="col-md-10">
                   <input id="question" type="text" class="form-control" name="question" value="{{ $data->question }}" required autofocus>
                   @if ($errors->has('question'))
                       <span class="help-block">
                           <strong>{{ $errors->first('question') }}</strong>
                       </span>
                   @endif
               </div>
           </div>

           <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
               <label for="answer" class="col-md-2 control-label">Answer</label>
               <div class="col-md-10">
                   <input id="answer" type="text" class="form-control" name="answer" value="{{ $data->answer }}" required autofocus>
                   @if ($errors->has('answer'))
                       <span class="help-block">
                           <strong>{{ $errors->first('answer') }}</strong>
                       </span>
                   @endif
               </div>
           </div>
           <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
             <label for="image" class="col-md-2 control-label">Current Image</label>
             <div style="width:300px;height:300px; margin:auto;">
               <img class="img-thumbnail" src='{{$data->image}}'/>
              </div>
               <label for="image" class="col-md-4 control-label">Image</label>
               <div class="col-md-6">
                   <input id="image"  type="file" name="image">
                   @if ($errors->has('image'))
                       <span class="help-block">
                           <strong>{{ $errors->first('image') }}</strong>
                       </span>
                   @endif
               </div>
           </div>
      </div>
     </div>
     </div>
     <div class="col-sm-6">
       <div class="panel panel-default">
         <div class="panel-body">
           <label for="explanation" class="col-md-4 control-label">Explanation</label>
               <textarea style="height:300px" type="text" class="form-control" name="explanation">{!!$data->explanation!!}</textarea>
               @if ($errors->has('explanation'))
                   <span class="help-block">
                       <strong>{{ $errors->first('explanation') }}</strong>
                   </span>
               @endif
         </div>
      </div>
     </div>
     <div class="form-group">
         <div class="col-md-12 col-md-offset-5">
             <button type="submit" class="btn btn-primary">
                 Update
             </button>
         </div>
    </div>
    </div>
    </div>
    </form>
  </div>
</div>
@endsection
