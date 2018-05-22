@extends('layouts.app')
@section('content')
  @foreach($studentResults->student_answers as $answer)
    {{$answer->questions->question}}{{$answer->correct}}<br />
  @endforeach
@endsection
