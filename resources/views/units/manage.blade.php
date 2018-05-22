@extends('layouts.backend')

@section('content')
<div class="page-header">
  <h1>units</h1>
</div>
<div class="row">
 <div class="col-sm-7">
   <table class="table table-striped">
     <thead>
       <tr>
         <th>unit Name</th>
         <th>No. of Questions</th>
         <th>Passmark</th>
       </tr>
     </thead>
     <tbody>
       @if(!empty($units))
       @endif
       @forelse($units as $unit)
       <tr>
         <td><a href="/test/{{$unit->id}}/manage">{{$unit->name}}</a></td>
         <td><a data-toggle="tooltip" title="Manage Example" href="/unit/{{$unit->id}}/questions"><i style="font-size:20px" class="ion-ios-gear"></i></a></td>
         <td><a data-toggle="tooltip" title="Edit" href="/education/{{$unit->id}}/edit"><i style="font-size:20px" class="ion-edit"></i></a></td>
         <td>
           @if($unit->visibility)
            <a data-toggle="tooltip" title="Visibility" href="/unit/{{$unit->id}}/visibility/">
              <i style="font-size:20px" class="ion-eye"></i>
            </a>
           @else
           <a data-toggle="tooltip" title="Visibility" href="/unit/{{$unit->id}}/visibility/">
             <i style="font-size:20px" class="ion-eye-disabled"></i>
           </a>
           @endif
         </td>
         <td>
           <a data-toggle="tooltip" title="Delete" href="/unit/{{$unit->id}}/delete">
             <i style="font-size:20px" class="ion-ios-trash"></i>
           </a>
         </td>
         <td>
           <a data-toggle="tooltip" title="Delete" href="/unit/{{$unit->id}}/results">
            results <i style="font-size:20px" class="ion-ios-trash"></i>
           </a>
         </td>
       </tr>
       @empty
          <p>
            There are no unit.
          </p>
       @endforelse

     </tbody>
   </table>
 </div>
 <div class="col-sm-5">
   <div class="row">
       <div class="col-md-8 col-md-offset-2">
           <div class="panel panel-default">
               <div class="panel-heading">Create unit</div>

               <div class="panel-body">
                   <form class="form-horizontal" method="POST" action="/unit/create">
                       {{ csrf_field() }}

                       <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                           <label for="name" class="col-md-4 control-label">unit Name</label>
                           <div class="col-md-6">
                               <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                               @if ($errors->has('name'))
                                   <span class="help-block">
                                       <strong>{{ $errors->first('name') }}</strong>
                                   </span>
                               @endif
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-6 col-md-offset-4">
                               <button type="submit" class="btn btn-primary">
                                   Create unit
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
