<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;

class SubjectController extends Controller
{
    public function create(){
      return view('subject.create');
    }
    public function store(request $request){
      $data = new Subject;
      $data->subject = $request->subject;
      $data->visibility = 1;
      $data->save();
      return redirect('subject/view');
    }
    public function view(){
      return Subject::all();
    }
    public function manage(){
      $subjects = Subject::all();
      return view('subject.manage',compact('subjects'));
    }
    public function edit(Subject $subject_id){
      return view('subject.edit',compact('subject_id'));
    }
    public function update(request $request){
      $subject = Subject::find($request->subject_id);
      $subject->subject = $request->subject;
      $subject->save();
      return redirect()->back();
    }
}
