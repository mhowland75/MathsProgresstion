<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use DB;

class AdminController extends Controller
{
    public function create(){
      return  view('auth.register');
    }
    public function store(request $request){
      $request->validate([
          'name' => 'required|max:30|min:2',
          'email' => 'required|max:50|email|unique:users,email',
          'job_title' => 'required|max:20|min:3',
          'access_level' => 'required',
          'password' => 'required',
          'password_confirmation' => 'required|same:password'
      ]);
      $data = new Admin;
      $data->name = $request->name;
      $data->email = $request->email;
      $data->job_title = $request->job_title;
      $data->password = bcrypt($request->password);
      $data->save();
      DB::table('administrator_privileges')->insert([
            ['user_id' => $data->id, 'access_level' => $request->access_level]
        ]);
      return redirect('admin/manage');
    }
    public function manage(){
      $data = Admin::all();
      return view('admin/manage',compact('data'));
    }
    public function manageAdministration(){
      $admins = DB::table('administrator_privileges')->get();
      $data = array();
      foreach ($admins as $admin) {
        $x = array();
        $userInfo = DB::table('users')->where('id',$admin->user_id)->get();
        $x['userinfo'] = $userInfo;
        $x['admininfo'] = $admin;
        $data[] = $x;
      }
      return view('admin.manageAdmin', compact('data'));
    }
    public function updateAdministrator(){
      if(isset($_POST)){
         unset($_POST['_token']);

        foreach($_POST as $id=>$access_level){
            $user = DB::table('administrator_privileges')->where('id',$id)->get();
              if($user[0]->user_id > '1'){

                DB::table('administrator_privileges')
                ->where('id', $id)
                ->update(['access_level' => $access_level]);
              }
            }
        }
      return redirect('/admin/manageAccess');
    }
    public function removeAdministrator($id){
      DB::table('administrator_privileges')->where('id', $id)->delete();
      return redirect('/admin/manageAccess');
    }
}
