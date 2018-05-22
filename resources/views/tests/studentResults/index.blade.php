@extends('layouts.app')

@section('content')
@foreach($tests as $test)
  @if($test->results)
    <a href="/studentsResults/view/{{$test->id}}">{{$test->name}}</a><br />
  @else
    {{$test->name}}<br />
  @endif
@endforeach
@endsection
