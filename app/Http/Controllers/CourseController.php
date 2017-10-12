<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(10);
        return view("pages.courses.view")->with([
            'courses' => $courses
        ]);
    }

    public function getEdit($id)
    {
        $course = Course::find($id);

        return view("pages.courses.edit")->with([
            'course' => $course
        ]);
    }

    public function postUpdate(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|min:2|max:45',
                'slug' => 'required|min:2|max:45',
                'description' => 'required|min:2|max:45',
            ]);
            $data = $request->all();
            $course = Course::find($data['id']);
            $course->fill($data);
            $course->save();
            return back()->with('status', 'Course updated.');
        } catch (\Exception $exception) {
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
                'name' => 'required|min:2|max:45',
                'slug' => 'required|min:2|max:45',
                'description' => 'required|min:2|max:45',
            ]);
            $data = $request->all();
            $course = new Course($data);
            $course->id = Uuid::uuid1();
            $course->save();
            return back()->with('status', 'Course created.');
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
