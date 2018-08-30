<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentsAnswer extends Model
{
  protected $table = 'students_answers';

  public function students_results(){
    return $this->belongsTo('App\StudentResult');
  }
  public function questions(){
    return $this->belongsTo('App\Question','question_id');
  }
  public function answers(){
    return $this->belongsTo('App\Answer','answer_id');
  }

  public static function delete_results_from_answer_deletion($id){
    $answers =  static::select('id')->where('answer_id',$id)->get();
    foreach($answers as $answer){
        StudentAnswer::destroy($answer->id);
    }
  }
  public static function delete_by_answerid($id){
        static::where('answer_id',$id)->delete();

  }
  public static function delete_by_questionid($id){
        static::where('question_id',$id)->delete();
  }

}
