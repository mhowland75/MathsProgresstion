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
      $message->save();
      $x = 'sdds';
      Mail::to($request->email)->send(new HelpStudents($request->name, $request->email, $request->subject, $request->message));
      return redirect('/help/view');
    }
    public function index(){
      $data = Help::all();
      return view('help.index',compact('data'));
    }
}
