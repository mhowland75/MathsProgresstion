<?php

namespace App\Http\Middleware;

use Closure;
use App\StudentLogin;

class Student
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if(StudentLogin::get_student_id()){
        if(StudentLogin::password_reset_status(StudentLogin::get_student_id())){
          return $next($request);
        }
        else{
          return redirect('/student/password_reset');
        }
      }
      else{
        return redirect('/student/login');
      }
    }
}
