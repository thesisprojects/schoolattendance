<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $incrementing = false;
    protected $fillable = ["student_id", "subject_id", "type"];
}
