<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      /*
        $newMail = DB::table('help')->where('viewed',0)->count();
        $bg = app('App\Http\Controllers\ip_addressController')->connectionCount();
        $totalLessons = DB::table('education')->count();
        $activeLessons = DB::table('education')->where('visibility', 1)->count();
        $courses = DB::table('department')->count();
        $teachers = DB::table('teachers')->count();
        $results = app('App\Http\Controllers\resultsController')->overAllstats2();
        $passmark = app('App\Http\Controllers\resultsController')->returnPassMark();
        $lessonPopularity = app('App\Http\Controllers\educationController')->lessonPopularity();
        $mostPopulareLesson = $lessonPopularity[0];
        $failedStudents = 100 - $results['perPassedStudents'];
        $passedStudents = array('passed'=>$results['perPassedStudents'],'failed'=>$failedStudents);
        $totalStudents = $results['totalStudents'];
        $perPassStudents = $results['perPassedStudents'];
        $totalVisits = DB::table('ip_address')->count();
        */
        //return $newMail;
        return view('home');
    }

}
