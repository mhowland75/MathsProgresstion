<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use App\StudentLogin;
class UnitsController extends Controller
{
  /**
   * Mangae unit
   */
    public function manage(){
      $units = Unit::get_all_units();
      foreach($units as $unit){
        $unit->status = Unit::unitActive($unit->id);
      }
      return view('units.manage',compact('units'));
    }
    /**
     * Store Unit
     */
    public function store(request $request){
      $request->validate([
        'name' => 'required|unique:units|max:30',

      ]);
      //$filename = $request->image->getClientOriginalName();
      $data = new Unit;
      $data->name = $request->name;
      $data->visibility = 0;
      //$data->created_by = Auth::id();
      $data->save();
      //$request->image->storeAs('public', $filename);
      return redirect()->back();
    }
    /**
     * Results
     */
    public function results(Unit $unit_id){
      $unit_tests = $unit_id->tests;
      foreach($unit_tests as $test){
        //return $test;
        foreach($test->studentsResults as $results){
          //return $results;
          foreach($results->student_answers as $answers){
            return $answers;

          }
        }
      }
      return $x->studentsResults;
    }
    /**
     * Delete Unit
     */
    public function delete($id){
      if(Unit::unitActive($id)){
        return Redirect()->back()->withErrors(['You are trying to modify an active unit. Modification of units is disabled while they are active.', '']);
      }
      Unit::unitDelete($id);
      return redirect()->back();
    }
}
