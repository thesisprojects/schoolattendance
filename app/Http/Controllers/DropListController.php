<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Student;

class DropListController extends Controller
{
    public function download()
    {

        $students = Student::with([
            'studentSubjects' => function($query)
            {
                $query->where('is_dropped', 1);
            },
            'studentSubjects.subject' => function($query)
            {

            }
        ])->get();
        $file = Excel::create('Students droplist', function ($excel) use ($students) {
            $excel->sheet('Page 1', function ($sheet) use ($students) {
                $sheet->appendRow(1, array(
                    'Student', 'Subject CC#', 'Subject'
                ));
                $sheet->cells('A1:D1', function ($cells) {
                    $cells->setBackground('#ac2925');
                    $cells->setFontColor('#ffffff');
                    $cells->setFontSize(16);
                    $cells->setFontWeight('bold');
                });
                foreach ($students as $student) {
                    foreach ($student->studentSubjects as $droppedSubject)
                    {
                        $sheet->appendRow(array(
                            $student->last_name . ', ' . $student->first_name, $droppedSubject->subject->cc_number, $droppedSubject->subject->name
                        ));
                    }
                }
            });
        });
        $file->download('xls');
    }
}
