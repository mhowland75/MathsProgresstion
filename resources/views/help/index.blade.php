@extends('layouts.backend')

@section('content')
<div class="row">
  <div id="inbox" class="col-sm-4">
    <?php $y=0 ?>
    @foreach ($data as $x)
      <div id="{{$y}}" onclick="showMessage({{$x->id}}); styling('{{$y}}');" <?php if($x->viewed < 1){echo'style="background-color:#F8F9F9;"';}else{echo'style="background-color:white;"';} ?> class="messageInfo">
        <div class="row">
          <div class="col-sm-10">
            <p style="font-size:20px">
              {{$x->name}}
            </p>
              {{$x->email}}<br />
              {{$x->subject}}
          </div>
          <div class="col-sm-2">
            <?php if($x->viewed > 0){echo'<i style="font-size:20px" class="ion-android-drafts"></i>';}else{echo'<i style="font-size:20px" class="ion-android-mail"></i>';} ?>
          </div>
        </div>
      </div>
      <?php $y++ ?>
    @endforeach
  </div>
  <div class="col-sm-8">
    <div class="panel panel-default">
      <div class="panel-body">
        <div id="txtHint"></div>
      </div>
    </div>
  </div>
</div>
<script>
  function styling(id){
    
    document.getElementById(id).style.color = "blue";
  }
  function removeStyles(el) {
    el.removeAttribute('style');

    if(el.childNodes.length > 0) {
        for(var child in el.childNodes) {
            /* filter element nodes only */
            if(el.childNodes[child].nodeType == 1)
                removeStyles(el.childNodes[child]);
        }
    }
}
</script>
<script>
function showMessage(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","/help/Ajax/"+str,true);
        xmlhttp.send();
    }
}
</script>
@endsection
