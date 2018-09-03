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
}
