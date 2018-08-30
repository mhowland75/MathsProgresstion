<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Student;
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
