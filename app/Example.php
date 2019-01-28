<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
      protected $table = 'examples';

      public function setNameAttribute($value)
      {
          $this->attributes['name'] = ucwords($value);
      }
      public function setQuestonAttribute($value)
      {
          $this->attributes['queston'] = ucfirst($value);
      }
      public function setAnswerAttribute($value)
      {
          $this->attributes['answer'] = ucfirst($value);
      }
      
}
