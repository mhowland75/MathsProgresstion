<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Help;
use App\Teachers;
use Mail;
use App\Mail\HelpStudents;
use Illuminate\Support\Facades\Storage;

class HelpController extends Controller
{
    public function view(){
      $data = Teachers::all();
      foreach($data as $x){
        $x->image = Storage::url($x->image);
      }
      return view('help.view', compact('data'));
    }
    public function store(request $request){
      $request->validate([
          'name' => 'required|max:50',
          'email' => 'required|email',
          'subject' => 'required|max:50',
          'message' => 'required|max:10000|min:5',
      ]);
      $message = new help;
      $message->name = $request->name;
      $message->email = $request->email;
      $message->subject = $request->subject;
      $message->message = $request->message;
      $message->viewed = 0;
      $message->save();
      $x = 'sdds';
      Mail::to($request->email)->send(new HelpStudents($request->name, $request->email, $request->subject, $request->message));
      return redirect('/help/view');
    }
    public function index(){
      if(empty($id)){
        $message = Help::first();
      }else{
        $message = Help::where('id',$id)->get();
      }
      $data = Help::orderBy('created_at', 'DESC')->get();

      return view('help.index',compact('data','message'));
    }
    public function viewMessage(){
      $data = Help::where('id',$id)->get();
      $f = Help::find($id);
      $f->viewed = 1;
      $f->save();
      //return $data;
      return view('help.message',compact('data'));
    }
      public function helpAjax($id){
        //return 'hello';
        $f = Help::find($id);
        $f->viewed = 1;
        $f->save();
        $data = Help::where('id',$id)->get();
        return view('help.mes',compact('data'));

      }

}
