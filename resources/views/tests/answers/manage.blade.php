@extends('layouts.backend')

@section('content')
<a href="/test/{{$id->test->id}}/questions"><button type="button" class="btn btn-primary"> <- Back</button></a>
<div class="page-header">
  <h1>{{$id->test->name}} - {{$id->question}}</h1>
</div>
<div class="row">
 <div class="col-sm-7">
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
         <td><a data-toggle="tooltip" title="Edit" href="/education/{{$answer->id}}/edit"><i style="font-size:20px" class="ion-edit"></i></a></td>
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
 <div class="col-sm-5">
   <div class="row">
       <div class="col-md-8 col-md-offset-2">
           <div class="panel panel-default">
               <div class="panel-heading">Create queston code</div>

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
                             <select name="right_answers">
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
