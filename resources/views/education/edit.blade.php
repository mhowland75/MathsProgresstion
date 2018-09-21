@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div id="main-panel-head"  class="panel-heading">
    <center>
      <h1>Edit {{$data->name}}</h1>
    </center>
  </div>
  <div id="main-panel-body" class="panel-body">
    <form class="form-horizontal" method="POST" action="/education/update" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{$data->id}}">
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
           <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
               <label for="subject" class="col-md-2 control-label">Subject</label>
               <div class="col-md-10">
                  <select class="form-control" id="sel1" name="subject_id">
                    @foreach($subjects as $subject)
                      <option value="{{$subject->id}}" <?php if($data->subject_id == $subject->id){echo"selected='selected'";} ?>>{{$subject->subject}}</option>
                    @endforeach
                  </select>
                   @if ($errors->has('subject'))
                       <span class="help-block">
                           <strong>{{ $errors->first('subject') }}</strong>
                       </span>
                   @endif
               </div>
           </div>

           <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
               <label for="description" class="col-md-2 control-label">Description</label>
               <div class="col-md-10">
                   <textarea style="height:200px" id="description" type="text" class="form-control" name="description">{!! $data->description !!}"</textarea>
                   @if ($errors->has('description'))
                       <span class="help-block">
                           <strong>{{ $errors->first('description') }}</strong>
                       </span>
                   @endif
               </div>
           </div>
         </div>
       </div>
       <div class="panel panel-default">
      <div class="panel-heading"><h3>Image/video</h3></div>
      <div class="panel-body">
        <div>
           <iframe style="margin-left:10%" width="80%" height="280px" src="{{$data->video}}" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="form-group{{ $errors->has('video') ? ' has-error' : '' }}">
            <label for="video" class="col-md-2 control-label">Video URL</label>
            <div class="col-md-10">
                <input id="video" type="text" class="form-control" name="video" value="{{ $data->video }}" required autofocus>
                @if ($errors->has('video'))
                    <span class="help-block">
                        <strong>{{ $errors->first('video') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <label for="image" class="col-md-2 control-label">Current Image</label>
        <div style="width:300px;height:300px; margin:auto;">
          <img class="img-thumbnail"  src='{{$data->image}}'/>
        </div>
        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
            <label for="image" class="col-md-2 control-label">Image</label>
            <div class="col-md-6">
                <input id="image" type="file" name="image">
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
            <div class="form-group{{ $errors->has('explanation') ? ' has-error' : '' }}">
                <div class="row">
                  <label for="explanation" class="col-md-3 control-label">Explanation</label>
                </div>
                <br />
                <div class="col-md-12">
                    <textarea style="height:400px" id="explanation" type="text" class="form-control" name="explanation">{!! $data->explanation !!}</textarea>
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
     <center>
       <button type="submit" class="btn btn-primary">
           Update
       </button>
     </center>
    </div>
    </form>
  </div>
</div>
@endsection
