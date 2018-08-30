<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use App\StudentYear;
class StudentLogin extends Model
{
    protected $table = 'students_login';

    public function studentYear(){
      return $this->belongsTo('App\StudentYear');
    }
    
    public static function student_password_update($student_id, $password){
      $password = bcrypt($password);
      static::where('student_id',$student_id)->update(['password' => $password,'password_reset' => 1]);
    }

    public static function studentAuth($student_id,$password){
      $x = static::where('student_id',$student_id)->where('active',1)->get();
      if(!empty($x[0])){
        $y = StudentYear::find($x[0]->student_year_id);
        if(!empty($x[0]->id) && !empty($y->student_login_active)){
          if(password_verify($password , $x[0]->password)){
            return TRUE;
          }else{
            return FALSE;
          }
        }else{
          return FALSE;
        }
      }else{
          return FALSE;
      }

    }

    public static function password_reset_status($student_id){
      $x = static::select('password_reset')->where('student_id',$student_id)->get();
      if(!empty($x[0]->password_reset)){
        return TRUE;
      }
      else{
        return FALSE;
      }
    }

    public static function start_student_session($student_id){
        Session::put('student_id', $student_id);
    }
    public static function end_student_session(){
        Session::flush();
        //Session::forget(Session::get('student_id'));
    }
    public static function get_student_id(){
      return Session::get('student_id');
    }

}
