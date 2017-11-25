<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teachers;
use Illuminate\Support\Facades\Storage;

class TeachersController extends Controller
{
    public function create(){
      return view('teachers.create');
    }
    public function store(request $request){
      $filename = $request->image->getClientOriginalName();
      $data = new Teachers;
      $data->name = $request->name;
      $data->job_title = $request->job_title;
      $data->image = $filename;
      $data->save();
      $request->image->storeAs('public', $filename);
      return redirect('teachers/manage');
    }
    public function manage(){
      $data = Teachers::all();
      foreach($data as $x){
        $x->image = Storage::url($x->image);
      }
      return view('teachers.manage',compact('data'));
    }
    public function edit($id){
      $data = Teachers::find($id);
      $data->image = Storage::url($data->image);
      return view('teachers.edit',compact('data'));
    }
    public function update(request $request){
      $data = Teachers::find($request->id);
      if ($request->hasFile('image')) {
          $filename = $request->image->getClientOriginalName();
          $request->image->storeAs('public', $filename);
          $data->image = $filename;
      }
      $data->name = $request->name;
      $data->job_title = $request->job_title;
      $data->save();
      return redirect('/teachers/manage');
    }
    public function delete($id){
      Teachers::destroy($id);
      return redirect('/teachers/manage');
    }
}
