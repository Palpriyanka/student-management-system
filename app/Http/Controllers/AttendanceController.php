<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index()
    {

        $teachers = Teacher::where('user_id', auth()->id())->firstOrFail();
        $students = DB::table('assign_teacher_to_classes')
            ->join('school_class', 'school_class.id', '=', 'assign_teacher_to_classes.class_id')
            ->join('students', 'students.class', '=', 'assign_teacher_to_classes.class_id')

            ->where('assign_teacher_to_classes.teacher_id', $teachers->id)
            ->get();
        return view(
            'attendance.index',
            compact('students')
        );
    }

    public function store(Request $request)
    {
        $teacher = Teacher::where('user_id', auth()->id())->first();;
        // dd($teacher->id);
        foreach ($request->student_id as $key => $studentId) {
            // print_r($studentId);
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'attendance_date' => now()->toDateString(),
                ],
                [
                    'status' => $request->status[$key],
                    'teacher_id' => $teacher->id,
                ]
            );
            return back()
                ->with(
                    'success',
                    'Attendance Saved'
                );
        }
    }
}
