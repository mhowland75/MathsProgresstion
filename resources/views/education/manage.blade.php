@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div id="main-panel-head"  class="panel-heading">
    <center>
      <h1>Education Management</h1>
    </center>
  </div>
  <div id="main-panel-body" class="panel-body">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row">
         <div class="col-sm-4"><a href="/education/create"><button  style="margin:20px; width:80%;" type="button" class="btn btn-primary">Create New Learning Aid</button></a></div>
         <div class="col-sm-4"></div>
         <div class="col-sm-4"><center><input style="margin:20px; width:80%;" class="form-control" id="myInput" type="text" placeholder="Search.."></center></div>
        </div>
        <ul class="nav nav-tabs">
          @foreach($array as $subject =>$c)
            <li><a data-toggle="tab" href="#{{$subject}}">{{$subject}}</a></li>
          @endforeach
        </ul>
        <div class="tab-content">
          @foreach($array as $subject => $c)
            <div id="{{$subject}}" class="tab-pane fade in active">
            <div class="panel-body">
              <table class="table table-striped">
              <thead>
                <tr>
                  <th></th>
                  <th>Concept</th>
                  <th>Introduction</th>
                  <th>Created By</th>
                  <th>Updated By</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($c as $x)
                <tr>
                  <td><img style="max-width:200px; min-width:100px"  class="img-thumbnail" src='{{$x->image}}'/></td>
                  <td>{{$x->name}}</td>
                  <td>{!!$x->description!!}</td>
                  <td>{{$x->created_by}}</td>
                  <td>{{$x->updated_by}}</td>
                  <td><a data-toggle="tooltip" title="Manage Example" href="/examples/{{$x->id}}/manage"><i style="font-size:20px" class="ion-ios-gear"></i></a></td>
                  <td><a data-toggle="tooltip" title="Edit" href="/education/{{$x->id}}/edit"><i style="font-size:20px" class="ion-edit"></i></a></td>
                  <td><a data-toggle="tooltip" title="Visibility" href="/education/manage/visibility/{{$x->id}}"><?php if($x->visibility == 1){echo'<i style="font-size:20px" class="ion-eye"></i>';}else{echo'<i style="font-size:20px" class="ion-eye-disabled"></i>';} ?></a></td>
                  <td><a data-toggle="tooltip" title="Remove" href="/education/{{$x->id}}/delete"><i style="font-size:20px" class="ion-android-delete"></i></a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            </div>
          </div>
          @endforeach

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
