
<ul class="list-group">
  <li class="list-group-item">{{$data[0]['name']}}</li>
  <li class="list-group-item">{{$data[0]['email']}}</li>
  <li class="list-group-item">{{$data[0]['subject']}}</li>
  <li class="list-group-item">{{$data[0]['created_at']}}</li>
</ul>
<div class="panel panel-default">
  <div class="panel-body">
    {{$data[0]['message']}}
  </div>
</div>
