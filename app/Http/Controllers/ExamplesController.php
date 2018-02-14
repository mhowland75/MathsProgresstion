<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Example;
use App\Education;
use App\User;
use Illuminate\Support\Facades\Storage;
use Auth;
use DB;

class ExamplesController extends Controller
{
    public function visibility($id){
      $status = DB::table('examples')->where('id',$id)->get();
      if($status[0]->visibility == 1){
        DB::table('examples')
              ->where('id', $id)
              ->update(['visibility' => 0, ]);
      }
      elseif($status[0]->visibility == 0){
        DB::table('examples')
              ->where('id', $id)
              ->update(['visibility' => 1, ]);
      }
      $x = $status[0]->education_id;
        return redirect('/examples/'.$x.'/manage');
    }
    public function create(request $request){
      $id = $request->id;
      $data = Education::find($id);
      return view('examples.create',compact('id','data'));
    }
    public function store(request $request){
      $request->validate([
          'name' => 'required|max:50|min:4',
          'introduction' => 'required|max:500',
          'explanation' => 'required|max:5000|min:500',
          'image' => 'required|image',
      ]);
      $data = new Example;
      $filename = $request->image->getClientOriginalName();
      $data->education_id = $request->id;
      $data->name = $request->name;
      $data->introduction = $request->introduction;
      $data->explanation = $request->explanation;
      $data->visibility = 0;
      $data->question = $request->question;
      $data->answer = $request->answer;
      $data->image = $filename;
      $data->created_by = Auth::id();
      $request->image->storeAs('public', $filename);
      $data->save();
      return redirect('/examples/'.$request->id.'/manage');
    }
    public function manage($id){
      $education = Education::find($id);
      $data = Example::where('education_id',$id)->get();
      foreach($data as $x){
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
      return view('examples.manage',compact('data','education'));
    }
    public function edit($id){
      $data = Example::find($id);
      $education = Education::find($data->education_id);
      $data->image = Storage::url($data->image);
      return view('examples.edit',compact('data','education'));
    }
    public function update(request $request){
      $request->validate([
          'name' => 'required|max:50|min:4',
          'introduction' => 'required|max:500',
          'explanation' => 'required|max:5000|min:500',
      ]);
      $data = Example::find($request->id);
      if ($request->hasFile('image')) {
          $filename = $request->image->getClientOriginalName();
          $request->image->storeAs('public', $filename);
          $data->image = $filename;
      }
      $data->name = $request->name;
      $data->introduction = $request->introduction;
      $data->explanation = $request->explanation;
      $data->question = $request->question;
      $data->answer = $request->answer;
      $data->updated_by = Auth::id();
      $data->save();
      return redirect('examples/'.$request->education_id.'/manage');
    }
    public function delete($id){
      Example::destroy($id);
      $data = Example::find($id);
      return redirect()->back();
    }

}
