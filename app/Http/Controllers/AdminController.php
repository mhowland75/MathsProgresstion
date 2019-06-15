<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\User;
use DB;
use Auth;

class AdminController extends Controller
{
  /**
   * Admin create
   */
  public function adminCreate(){
    $user = new User;
    $user->name = 'Admin';
    $user->email = 'admin@admin.com';
    $user->password = bcrypt('123456@m');
    $user->job_title = 'admin';
    $user->save();
    DB::insert('insert into administrator_privileges (user_id, access_level) values (?, ?)', [$user->id, 1]);
  }
  /**
   * Admin Delete
   */
  public function delete($id){
    if(empty(User::find($id))){
      return redirect('/admin/manage');
    }
    User::destroy($id);
    DB::table('administrator_privileges')->where('user_id', '=', $id)->delete();
    return redirect('/admin/manage');
  }
  /**
   * Admin edit
   */
    public function edit($id){
      $data = User::find($id);
      return view('admin.edit',compact('data'));
    }
    /**
     * Admin Update
     */
    public function update(request $request){
      $data = User::find($request->id);
      $data->name = $request->name;
      $data->email = $request->email;
      $data->job_title = $request->job_title;
      if(!empty($request->password)){
        if($request->password === $request->password_confirmation){
          $data->password = bcrypt($request->password);
        }
      }
      $data->save();
      return redirect('admin/manage');
    }
    /**
     * Admin Store
     */
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
    /**
     * Admin Manage
     */
    public function manage(){
      $admins = DB::table('administrator_privileges')->get();
      $data = array();
      foreach ($admins as $admin) {
        $x = array();
        $userInfo = DB::table('users')->where('id',$admin->user_id)->get();
        $x['userinfo'] = $userInfo;
        $x['admininfo'] = $admin;
        $data[] = $x;
      }
      return view('admin/manage',compact('data'));
    }
    /**
     * Update admin
     */
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
      return redirect('/admin/manage');
    }
    /**
     * Remove admin
     */
    public function removeAdministrator($id){
      DB::table('administrator_privileges')->where('id', $id)->delete();
      return redirect('/admin/manage');
    }
}
