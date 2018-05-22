<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\StudentLogin;
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
         $view->with('student_id', StudentLogin::get_student_id());
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
