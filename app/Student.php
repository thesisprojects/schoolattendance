<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $incrementing = false;
    protected $fillable = ["id_number", "first_name", "last_name", "course_id", "parent_contact_number", "start_year"];

    public function subjects()
    {
        return $this->belongsToMany('App\Subject', 'student_subjects', 'student_id', 'subject_id');
    }

    public function studentSubjects()
    {
        return $this->hasMany('App\StudentSubject');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function attendances()
    {
        return $this->hasMany('App\Attendance');
    }
}
