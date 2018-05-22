@extends('layouts.app')

@section('content')
  @foreach($tests as $test)
    <a href="/test/{{$test->id}}/view">{{$test->name}}</a><br />
  @endforeach
@endsection
