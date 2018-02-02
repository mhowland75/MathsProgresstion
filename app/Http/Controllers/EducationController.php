<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Education;
use App\Example;
use App\User;
use Illuminate\Support\Facades\Storage;
use Auth;


class EducationController extends Controller
{

    public function store(request $request){
      $request->validate([
          'name' => 'required|max:50|min:4|unique:education,name',
          'description' => 'required|max:500',
          'explanation' => 'required|max:5000|min:1000',
          'image' => 'required|image',
          'video' => 'required|url',
      ]);
      $filename = $request->image->getClientOriginalName();
      $data = new Education;
      $data->subject = $request->subject;
      $data->name = $request->name;
      $data->description = $request->description;
      $data->explanation = $request->explanation;
      $data->image = $filename;
      $data->video = $request->video;
      $data->created_by = Auth::id();
      $data->save();
      $request->image->storeAs('public', $filename);
      return redirect('education/manage');
    }
    public function create(){
      return view('education.create');
    }

    public function view($id){
      if(empty(Education::find($id))){
        $data = Education::first();
        $id = $data->id;
      }
      $data = Education::find($id);
      $data->image = Storage::url($data->image);
      $examples = Example::where('education_id',$id)->get();
      foreach($examples as $example){
        $example->image = $example->image = Storage::url($example->image);
      }
      return view('education.view', compact('data','examples'));
    }

    public function index($subject){
        $data = Education::where('subject',$subject)->get();
        foreach($data as $x){
          $x->image = Storage::url($x->image);
        }
        $subject = ucfirst($subject);
        return view('education.index', compact('data','subject'));
    }
    public function manage(){
      $maths = Education::where('subject','Maths')->get();
      foreach($maths as $x){
        $x->image = Storage::url($x->image);
        $user = User::find($x->created_by);
        $x->created_by = $user->name;
        $user = User::find($x->updated_by);
        if(!$user){
          $x->updated_by = 'Never Updated';
        }else{
          $x->updated_by = $user->name;
        }
      }
      $english = Education::where('subject','English')->get();
      foreach($english as $x){
        $x->image = Storage::url($x->image);
        $user = User::find($x->created_by);
        $x->created_by = $user->name;
        $user = User::find($x->updated_by);
        if(!$user){
          $x->updated_by = 'Never Updated';
        }else{
          $x->updated_by = $user->name;
        }
      }
      return view('education.manage', compact('maths','english'));
    }
    public function edit($id){
      if(empty(Education::find($id))){
        return redirect('/education/manage');
      }
      $data = Education::find($id);
      $data->image = Storage::url($data->image);
      return view('education.edit',compact('data'));
    }
    public function update(request $request){
      $request->validate([
          'name' => 'required|max:50|min:4',
          'description' => 'required|max:500',
          'explanation' => 'required|max:5000|min:1000',
          'video' => 'required|url',
      ]);
      $data = Education::find($request->id);
      if ($request->hasFile('image')) {
          $filename = $request->image->getClientOriginalName();
          $request->image->storeAs('public', $filename);
          $data->image = $filename;
      }
      $data->name = $request->name;
      $data->description = $request->description;
      $data->explanation = $request->explanation;
      $data->video = $request->video;
      $data->updated_by = Auth::id();
      $data->save();
      return redirect('/education/manage');
    }
    public function delete($id){
      if(empty(Education::find($id))){
        return redirect('/education/manage');
      }
      Education::destroy($id);
      return redirect('/education/manage');
    }
}
