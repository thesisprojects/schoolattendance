<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class PrefectController extends Controller
{
    public function postExcempt(Request $request)
    {
        $data = $request->all();
        $student = Student::find($data['student_id']);
        $student->is_excempted = !$student->is_excempted;
        $student->save();
        return back()->with('status', 'Excempted student');
    }
}
