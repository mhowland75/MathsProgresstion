@extends('layouts.backend')
@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <div class="panel panel-default">
            <div class="panel-heading">Create Questions</div>

            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="/question/edit" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <input type="hidden" name="question_id" value="{{$question->id}}">

                    <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                        <label for="question" class="col-md-4 control-label">Question</label>
                        <div class="col-md-6">
                            <input id="question" type="text" class="form-control" name="question" value="{{$question->question}}" required autofocus>
                            @if ($errors->has('question'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('question') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    @if($question->image)
                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                        <label for="image" class="col-md-4 control-label">Current Image</label>
                        <div class="col-md-6">
                            <img style="max-width:200px; min-width:100px"  class="img-thumbnail" src='{{$question->image}}'/>
                        </div>
                    </div>
                     @else
                     <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                         <label for="image" class="col-md-4 control-label">Current Image</label>
                         <div class="col-md-6">
                             No Image
                         </div>
                     </div>
                    @endif
                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                        <label for="image" class="col-md-4 control-label">Remove Image</label>
                        <div class="col-md-6">
                            <input type="checkbox" name="rem_image" value="1"> Remove Image<br>
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
                                Update Question
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
