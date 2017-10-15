<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Classes\TextMessageSender;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Mockery\Exception;
use Ramsey\Uuid\Uuid;

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
            $timeStart = $today->copy()->hour($timeStartArray[0])->minute($timeStartArray[1]);
            $timeEndArray = explode(':', $subject->time_end);
            $timeEnd = $today->copy()->hour($timeEndArray[0])->minute($timeEndArray[1]);
            if ($timeStart->isPast() && $timeEnd->isFuture()) {
                $currentSubject = $subject;
                break;
            }
        }
        if(!is_null($currentSubject))
        {
            $timeStart = explode(':', $currentSubject->time_start);
            $timeEnd = explode(':', $currentSubject->time_end);
            $dateBetween = [$today->copy()->hour($timeStart[0])->minute($timeStart[1]), $today->copy()->hour($timeEnd[0])->minute($timeEnd[1])];
            $attendance = Attendance::whereBetween('created_at', $dateBetween)->get();
            $students = $currentSubject->students->whereNotIn('id', $attendance->pluck('student_id'));
            return view("pages.attendance.index")->with(['subject' => $currentSubject, 'students' => $students]);
        }
        return view("pages.attendance.noclass");
    }

    public function postAttendance(Request $request)
    {
        try {
            $data = $request->all();
            $attendance = new Attendance($data);
            $attendance->id = Uuid::uuid1();
            $attendance->save();
            return [
                "message" => "Attendance saved",
            ];
        } catch (Exception $exception) {
            return [
                "message" => $exception->getMessage()
            ];
        }

    }

    public function notifyParent(Request $request)
    {
        $data = $request->all();
        TextMessageSender::sendTextMessage($data["phone_number"], $data["content"]);
    }

}
