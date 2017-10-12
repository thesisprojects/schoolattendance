<?php

namespace App\Http\Controllers;

use App\Course;
use App\Student;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::paginate(10);
        $courses = Course::all();
        return view("pages.students.view")->with([
            'students' => $students,
            'courses' => $courses
        ]);
    }

    public function getEdit($id)
    {
        $student = Student::find($id);
        $courses = Course::where('id', '!=', $student->course_id)->get();
        return view("pages.students.edit")->with([
            'student' => $student,
            'courses' => $courses
        ]);
    }

    public function postUpdate(Request $request)
    {
        try {
            $this->validate($request, [
                'id_number' => 'required|min:11|max:11',
                'first_name' => 'required|min:2|max:40',
                'last_name' => 'required|min:2|max:40',
                'course_id' => 'required|min:2|max:40',
                'parent_contact_number' => 'required|min:11|max:11',
                'start_year' => 'required',
            ]);
            $data = $request->all();
            $student = Student::find($data['id']);
            $student->fill($data);
            $student->save();
            return back()->with('status', 'User updated.');
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function postCreate(Request $request)
    {
        try {
            $this->validate($request, [
                'id_number' => 'required|min:11|max:11',
                'first_name' => 'required|min:2|max:40',
                'last_name' => 'required|min:2|max:40',
                'course_id' => 'required|min:2|max:40',
                'parent_contact_number' => 'required|min:11|max:11',
                'start_year' => 'required',
            ]);
            $data = $request->all();
            $student = new Student($data);
            $student->id = Uuid::uuid1();
            $student->save();
            return back()->with('status', 'Student created.');
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
