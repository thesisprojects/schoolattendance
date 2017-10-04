<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;
use App\Student;
use Ramsey\Uuid\Uuid;

class SubjectAssignController extends Controller
{
    public function index($id)
    {
        $student = Student::with(["subjects", "course"])->where('id', $id)->firstOrFail();
        $subjects = Subject::whereNotIn('id', $student->subjects->pluck('id'))->get();
        return view("pages.students.assigner.index")->with([
            "subjects" => $subjects,
            "student" => $student
        ]);
    }

    public function postAssignSubject(Request $request)
    {
        try {
            $data = $request->all();
            $student = Student::find($data['student']);
            $student->subjects()->attach($data['subject'], ['id' => Uuid::uuid1()]);
            return redirect()->back()->with('status', 'Subject added');
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
