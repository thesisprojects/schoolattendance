<?php

namespace App\Console\Commands;

use App\Student;
use App\Subject;
use Illuminate\Console\Command;
use App\Classes\TextMessageSender;

class StudentDropper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'students:drop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop students that has atleast 3 absents';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $subjects = Subject::with([
            'students' => function ($query) {
                $query->where('is_dropped', '0')->whereNotNull('course_id');
            },
            'students.studentSubjects' => function ($query) {

            },
            'students.attendances' => function ($query) {
                $query->where('type', 'absent')->orWhere('type', 'late');
            }
        ])->get();
        foreach ($subjects as $subject) {
            $this->info('Processing ' . $subject->name . ' with ' . $subject->students->count() . ' student(s)');
            foreach ($subject->students as $student) {
                $absents = $student->attendances->where('type', 'absent');
                $this->info('Processing ' . $student->last_name . ', ' . $student->first_name . ' with ' . $absents->count() . ' absents!');
                if ($absents->count() > 2) {
                    $studentSubject = $student->studentSubjects->where('subject_id', $subject->id)->first();
                    $studentSubject->is_dropped = 1;
                    $studentSubject->save();
                    $this->info('Dropped ' . $student->last_name . ', ' . $student->first_name . ' with ' . $absents->count() . ' absents!');
                    $this->info('NOTIFYING PARENT!');
                    TextMessageSender::sendTextMessage($student->parent_contact_number, $student->last_name . ' ' . $student->first_name . " has been marked as dropped on subject " . $subject->name);
                    $this->info('PARENT NOTIFIED!');
                } else {
                    $this->info('Not dropped ' . $student->last_name . ', ' . $student->first_name . ' with ' . $absents->count() . ' absents!');
                }
            }
        }
    }
}
