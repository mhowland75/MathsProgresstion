<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class ip_addressController extends Controller
{
  public function activity(){
    $connectionsLastWeek = DB::table('ip_address')->where('created_at', '<', Carbon::now())
    ->where('created_at', '>', Carbon::now()->subDays(29))
    ->count();
    $totalConnections = DB::table('ip_address')->count();
    $bg = $this->connectionCount();
    $data = DB::table('ip_address')->paginate(100);
    return view('activity.activity', compact('data','bg'));
  }
  public function timeIncrements(){
    $array = array();
    $now =Carbon::Now();
    $dt = Carbon::create(2018, 1, 1, 0);
    //return $dt->addMonths(2);
    $x = 0;
    while($dt < $now){
      $dt = Carbon::create(2018, 1, 1, 0);
      $dt = $dt->addMonths($x);
       $array[] = $dt;
       $x++;
    }
    return $array;
  }
  public function connectionCount(){
    $dates = $this->timeIncrements();
    $array = array();
    $first = 0;
    foreach ($dates as $date) {
      if(!$first == 0){
        $connections = DB::table('ip_address')->where('created_at', '<', $date)
        ->where('created_at', '>', $first)
        ->count();
        $first->month = $first->month - 1;
        $m = $first->year.', '.$first->month;
        $array[] = array($connections,$m);
      }
      $first = $date;
    }
    return $array;
  }
}
