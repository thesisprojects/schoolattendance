<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AttendanceSystemController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Hong_Kong');
    }

    public function index()
    {
        $today = Carbon::now();
        $subjects = Auth::user()->subjects()->with('students')->where('schedule', 'like', '%' . $today->copy()->dayOfWeek . '%')->get();
        $currentSubject = null;
        foreach ($subjects as $subject) {
            $timeStartArray = explode(':', $subject->time_start);
            $timeStart = $today->copy()->hour($timeStartArray[0], $timeStartArray[1]);
            $timeEndArray = explode(':', $subject->time_end);
            $timeEnd = $today->copy()->hour($timeEndArray[0], $timeEndArray[1]);
            if ($timeStart->isPast() && $timeEnd->isFuture()) {
                $currentSubject = $subject;
                break;
            }
        }
        dd(!is_null($currentSubject) ? $currentSubject->name : "NO SUBJECT CLASSES WITHIN THIS HOUR.");
    }

}
