<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
      protected $table = 'department';

    public function setDepartmentAttribute($value)
    {
        $this->attributes['department'] = ucfirst($value);
    }
    public function setCourseNameAttribute($value)
    {
        $this->attributes['course_name'] = ucwords($value);
    }
    public function setGroupCodeAttribute($value)
    {
        $this->attributes['group_code'] = strtoupper($value);
    }
}
