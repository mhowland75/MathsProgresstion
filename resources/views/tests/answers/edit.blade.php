@extends('layouts.backend')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$answer->question->test->name}} - {{$answer->question->question}}</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/answer/edit">
                        {{ csrf_field() }}

                        <input type="hidden" name="answer_id" value="{{$answer->id}}" />

                        <div class="form-group{{ $errors->has('answers') ? ' has-error' : '' }}">
                            <label for="answers" class="col-md-4 control-label">Answer</label>
                            <div class="col-md-6">
                                <input id="answers" type="text" class="form-control" name="answers" value="{{$answer->answers}}" required autofocus>
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
                                 <option value="0"<?php if($answer->right_answer == 0){echo'selected';} ?>>No</option>
                                 <option value="1" <?php if($answer->right_answer == 1){echo'selected';} ?>>Yes</option>
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
                                    Update Answer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
