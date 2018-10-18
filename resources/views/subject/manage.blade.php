@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div id="main-panel-head"  class="panel-heading">
    <center>
      <h1>
        Manage Subjects
      </h1>
    </center>
  </div>
  <div id="main-panel-body" class="panel-body">
    <div class="row">
     <div class="col-sm-8">
        <div class="panel panel-default">
          <div class="panel-body">
            <table class="table table-striped">
             <thead>
               <tr>
                 <th>Subject</th>
                 <th>Lesson Count</th>
                 <th>Email</th>
               </tr>
             </thead>
             <tbody>
               @foreach($subjects  as $subject)
                 <tr>
                   <td>{{$subject->subject}}</td>
                   <td>{{$subject->lessons->count()}}</td>
                   <td><a href="/subject/edit/{{$subject->id}}"><i style="font-size:20px" class="ion-edit"></i></a></td>
                 </tr>
               @endforeach
             </tbody>
           </table>
          </div>
        </div>
     </div>
     <div class="col-sm-4">
       <div class="col-md-12">
           <div class="panel panel-default">
               <div class="panel-heading">Create New Subject</div>

               <div class="panel-body">
                   <form class="form-horizontal" method="POST" action="/subject/create">
                       {{ csrf_field() }}

                       <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                           <label for="subject" class="col-md-4 control-label">Subject</label>
                           <div class="col-md-6">
                               <input id="subject" type="text" class="form-control" name="subject" value="{{ old('subject') }}" required autofocus>
                               @if ($errors->has('subject'))
                                   <span class="help-block">
                                       <strong>{{ $errors->first('subject') }}</strong>
                                   </span>
                               @endif
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-6 col-md-offset-4">
                               <button type="submit" class="btn btn-primary">
                                   Add Subject
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

@endsection
