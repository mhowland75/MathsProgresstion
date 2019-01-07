<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Education;

class SubjectController extends Controller
{
    public function delete($subject_id){
      $lessons = Education::where('subject_id',$subject_id)->get();
      foreach($lessons as $lesson){
        $lesson->subject_id = 0;
        $lesson->save();
      }
      Subject::destroy($subject_id);
    }
    public function store(request $request){
      $data = new Subject;
      $data->subject = $request->subject;
      $data->visibility = 1;
      $data->save();
      return redirect('subject/manage');
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
