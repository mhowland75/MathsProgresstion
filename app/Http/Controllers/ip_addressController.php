<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ip_addressController extends Controller
{
  public function activity(){
    $data = DB::table('ip_address')->paginate(100);
    //return $ip;
    return view('activity.activity', compact('data'));
  }

}
