@extends('layouts.backend')

@section('content')
<div class="page-header">
  <h1>Create Example - {{$data->name}}</h1>
</div>
<form class="form-horizontal" method="POST" action="/examples/store" enctype="multipart/form-data">
  {{ csrf_field() }}
    <input type="hidden" name="id" value="{{$id}}"/>
<div class="row">
 <div class="col-sm-6">
   <div class="panel panel-default">
     <div class="panel-body">
       <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
           <label for="name" class="col-md-2 control-label">Example Name</label>
           <div class="col-md-10">
               <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
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
               <textarea id="introduction" type="text" class="form-control" name="introduction">{!! old('introduction') !!}</textarea>
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
               <input id="question" type="text" class="form-control" name="question" value="{{ old('question') }}" required autofocus>
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
               <input id="answer" type="text" class="form-control" name="answer" value="{{ old('answer') }}" required autofocus>
               @if ($errors->has('answer'))
                   <span class="help-block">
                       <strong>{{ $errors->first('answer') }}</strong>
                   </span>
               @endif
           </div>
       </div>
       <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
           <label for="image" class="col-md-4 control-label">Image</label>
           <div class="col-md-6">
               <input id="image" type="file" name="image" value="{{ old('image') }}" required autofocus>
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
                   Create Example
               </button>
           </div>
     </div>
  </div>
 </div>
 </div>
 <div class="col-sm-6">
   <div class="panel panel-default">
     <div class="panel-body">
       <label for="explanation" class="col-md-4 control-label">Explanation</label>

           <textarea style="height:300px" type="text" class="form-control" name="explanation">{{ old('explanation') }}</textarea>
           @if ($errors->has('explanation'))
               <span class="help-block">
                   <strong>{{ $errors->first('explanation') }}</strong>
               </span>
           @endif

     </div>
  </div>
 </div>
</div>
</div>
</form>
@endsection
