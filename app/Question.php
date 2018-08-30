<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class question extends Model
{

    public function test(){
      return $this->belongsTo('App\Test');
    }
    public function answers(){
      return $this->hasMany('App\Answer');
    }
    public static function get_question_in_test($test_id){
      return static::where('test_id',$test_id)->get();
    }
    public static function count_question_in_test($test_id){
      return static::where('test_id',$test_id)->count();
    }
    public static function change_visibility($question_id){
      $visibility = static::select('visibility')->where('id',$question_id)->get();
      if($visibility[0]->visibility == 1){
        static::where('id',$question_id)->update(['visibility' => 0]);
      }
      else{
        static::where('id',$question_id)->update(['visibility' => 1]);
      }
    }
    public static function deleteQuestion($question_id){
      $answers = Answer::where('question_id',$question_id)->get();
      foreach($answers as $answer){
        $answer->delete();
      }
      static::destroy($question_id);
    }
}
