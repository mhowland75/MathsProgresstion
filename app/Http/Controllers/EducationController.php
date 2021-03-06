<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Education;
use App\Example;
use App\User;
use App\Subject;
use Illuminate\Support\Facades\Storage;
use Auth;
use DB;


class EducationController extends Controller
{

  public function visibility($id){
    $status = DB::table('education')->where('id',$id)->get();
    if($status[0]->visibility == 1){
      DB::table('education')
            ->where('id', $id)
            ->update(['visibility' => 0, ]);
    }
    elseif($status[0]->visibility == 0){
      DB::table('education')
            ->where('id', $id)
            ->update(['visibility' => 1, ]);
    }
      return redirect('/education/manage');
  }
    /**
     * Handels the education form request.
     */
    public function store(request $request){
      $request->validate([
          'name' => 'required|max:50|min:2|unique:education,name',
          'description' => 'required|max:2000',
          'explanation' => 'required|max:5000',
          'image' => 'required|image|dimensions:max_width=850,max_height=850',
          'video' => 'required|url',
      ]);
      $filename = $request->image->getClientOriginalName();
      $data = new Education;
      $data->subject = 0;
      $data->subject_id = $request->subject_id;
      $data->name = $request->name;
      $data->description = $request->description;
      $data->visibility = 0;
      $data->explanation = $request->explanation;
      $data->image = $filename;
      $data->video = $request->video;
      $data->views = 0;
      $data->created_by = Auth::id();
      $data->save();
      $request->image->storeAs('public', $filename);
      return redirect('education/manage');
    }
    public function create(){
      $subjects = Subject::getSubjects();
      return view('education.create', compact('subjects'));
    }
    /**
     * Education view
     */
    public function view($id){

      if(empty(Education::find($id))){
        $data = Education::first();
        $id = $data->id;
      }
      $data = Education::find($id);
      $views =  $data->views + 1;
      DB::table('education')
            ->where('id', $id)
            ->update(['views' => $views]);
      $data->image = Storage::url($data->image);
      $examples = Example::where('education_id',$id)->get();
      foreach($examples as $example){
        $example->image = $example->image = Storage::url($example->image);
      }
      return view('education.view', compact('data','examples'));
    }
    /**
     * Education Index
     */
    public function index(Subject $subject_id){
        $data = Education::where('subject_id',$subject_id->id)->where('visibility', 1)->get();
        foreach($data as $x){
          $x->image = Storage::url($x->image);
        }
        $subject = ucfirst($subject_id->subject);
        return view('education.index', compact('data','subject'));
    }
    /**
     * Education manage 
     */
    public function manage(){
      $array = array();
      $subjects = subject::getSubjects();
      foreach($subjects as $subject){
        $xe = Education::where('subject_id',$subject->id)->get();
        $unassociated = Education::where('subject_id',0)->get();
        foreach($xe as $x){
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
        $array[$subject->subject] = $xe;
      }

      $unassociated = Education::where('subject_id',0)->get();
      foreach($unassociated as $y){
        $y->image = Storage::url($y->image);
        $user = User::find($y->created_by);
        $y->created_by = $user->name;
        $user = User::find($y->updated_by);
        if(!$user){
          $y->updated_by = 'Never Updated';
        }else{
          $y->updated_by = $user->name;
        }
      }

      $array['Unassociated'] = $unassociated;
      return view('education.manage', compact('array'));
    }
    /**
     * Education edit
     */
    public function edit($id){
      if(empty(Education::find($id))){
        return redirect('/education/manage');
      }
      $subjects = Subject::getSubjects();
      $data = Education::find($id);
      $data->image = Storage::url($data->image);
      //return $data->subject_subject;
      return view('education.edit',compact('data','subjects'));
    }
    /**
     * Education update
     */
    public function update(request $request){
      $request->validate([
          'name' => 'required|max:50|min:4',
          'description' => 'required|max:2000',
          'explanation' => 'required|max:5000',
          'video' => 'required|url',
      ]);
      $data = Education::find($request->id);
      if ($request->hasFile('image')) {
          $filename = $request->image->getClientOriginalName();
          $request->image->storeAs('public', $filename);
          $data->image = $filename;
      }
      $data->subject = 0;
      $data->subject_id = $request->subject_id;
      $data->name = $request->name;
      $data->description = $request->description;
      $data->explanation = $request->explanation;
      $data->video = $request->video;
      $data->updated_by = Auth::id();
      $data->save();
      return redirect('/education/manage');
    }
    /**
     * Education delete
     */
    public function delete($id){
      if(empty(Education::find($id))){
        return redirect('/education/manage');
      }
      Education::destroy($id);
      return redirect('/education/manage');
    }
    /**
     * Education popularity
     */
    public function lessonPopularity(){
      $data = Education::select('name','views')->orderBy('views', 'DESC')->get();
      $r = 1;
      foreach($data as $x){
        $x->rank = $r;
        $r++;

      }
      return $data;
    }
    /**
     * Education populartity view
     */
    public function popularityView(){
      $data = $this->lessonPopularity();
        return view('education.popularity',compact('data'));
    }
}
