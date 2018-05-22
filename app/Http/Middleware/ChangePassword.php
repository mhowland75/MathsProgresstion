<?php

namespace App\Http\Middleware;

use Closure;
use App\StudentLogin;

class ChangePassword
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
        return $next($request);
      }
      else{
        return redirect('/student/login');
      }
    }
}
