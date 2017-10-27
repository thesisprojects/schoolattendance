<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $incrementing = false;
    protected $fillable = ["student_id", "subject_id", "type"];

    public function student()
    {
        return $this->belongsTo("App\Student");
    }

    public function subject()
    {
        return $this->belongsTo("App\Subject");
    }

    public function getReadableAbsentDate()
    {
        return Carbon::parse($this->created_at)->toDateString();
    }
}
