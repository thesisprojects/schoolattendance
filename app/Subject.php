<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public $incrementing = false;
    protected $fillable = ["name", "description", "schedule", "time_start", "time_end", "assigned_teacher", "cc_number"];

    public function students()
    {
        return $this->belongsToMany('App\Student', 'student_subjects', 'subject_id', 'student_id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\User', 'assigned_teacher');
    }
}
