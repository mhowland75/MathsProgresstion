<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Student;
use App\Subject;
use View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Schema::defaultStringLength(191);
      View::composer('*', function($view){
         $view->with('student', Student::getStudentInfo());
      });
      View::composer('*', function($view){
         $view->with('lessonSubjects', Subject::getSubjects());
      });
      View::composer('*', function($view){
         $view->with('testSubjects', Subject::getSubjects());
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
