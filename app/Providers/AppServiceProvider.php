<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Student;
use App\Subject;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

      View::composer('*', function($view){
         $view->with('student', Student::getStudentInfo());
      });
      View::composer('*', function($view){
         $view->with('lessonSubjects', Subject::lessonSubjects());
      });
      View::composer('*', function($view){
         $view->with('testSubjects', Subject::testSubjects());
      });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
