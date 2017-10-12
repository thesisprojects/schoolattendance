<?php

namespace App\Http\Controllers;

use App\subject;
use App\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class subjectController extends Controller
{
    public function index()
    {
        $teachers = User::where('isTeacher', 1)->get();
        $subjects = Subject::with('teacher')->paginate(10);
        return view("pages.subjects.view")->with([
            'subjects' => $subjects,
            'teachers' => $teachers
        ]);
    }

    public function getEdit($id)
    {
        $subject = Subject::find($id);
        return view("pages.subjects.edit")->with([
            'subject' => $subject
        ]);
    }

    public function postUpdate(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|min:2|max:45',
                'schedule' => 'required',
                'time_start' => 'required|min:2|max:45',
                'time_end' => 'required|min:2|max:45',
                'description' => 'required|min:2|max:45',
            ]);
            $data = $request->all();
            $subject = Subject::find($data['id']);
            $subject->fill($data);
            $subject->save();
            return back()->with('status', 'Subject updated.');
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
                'name' => 'required|min:2|max:45',
                'schedule' => 'required',
                'time_start' => 'required|min:2|max:45',
                'time_end' => 'required|min:2|max:45',
                'description' => 'required|min:2|max:45',
            ]);
            $data = $request->all();
            $subject = new Subject($data);
            $subject->id = Uuid::uuid1();
            $subject->save();
            return back()->with('status', 'Subject created.');
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
