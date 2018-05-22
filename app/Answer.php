<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  public function question(){
    return $this->belongsTo('App\Question');
  }
  public function answers(){
    return $this->hasMany('App\StudentsAnswer');
  }
  public static function check_and_change_correct_answer($test_id,$question_id,$answer_id = NULL){
      $answer = Answer::where('test_id',$test_id)->where('question_id',$question_id)->where('right_answer',1)->count();
      if($answer){
          Answer::where('test_id',$test_id)->where('question_id',$question_id)->where('right_answer',1)->update(['right_answer' => 0]);
      }
      if($answer_id){
          Answer::where('id',$answer_id)->update(['right_answer' => 1]);
      }
  }
  public static function return_answers_to_questions($question_id){
     $answers = static::where('question_id',$question_id)->get();
     return $answers[0];
  }
  public static function get_test_correct_answers($test_id){
      $questions = Question::get_question_in_test($test_id);
      $correct_answers = array();
      foreach($questions as $question){
        $x = static::where('question_id',$question->id)->where('right_answer',1)->get();
        $correct_answers[$question->id] = $x[0];
      }
      return $correct_answers;
  }

  public static function get_test_results($results){
    $correct_answers = 0;
    foreach($results as $question_id => $answer_id){
      $x = static::where('question_id',$question_id)->where('id',$answer_id)->where('right_answer',1)->get();
      if(!empty($x[0]->id)){
        $correct_answers++;
      }
    }
    return $correct_answers;
  }

  public static function get_is_answer_correct($question_id, $answer_id){
    $x = static::where('question_id',$question_id)->where('id',$answer_id)->where('right_answer',1)->get();
    //return $x;
    if(empty($x[0]->id)){
      return 0;
    }
    else{
      return 1;
    }
  }

  public static function change_visibility($answer_id){
    $visibility = static::select('visibility')->where('id',$answer_id)->get();
    if($visibility[0]->visibility == 1){
      static::where('id',$answer_id)->update(['visibility' => 0]);
    }
    else{
      static::where('id',$answer_id)->update(['visibility' => 1]);
    }
  }

  public static function delete_answer($id){
    static::destroy($id);
  }
}
