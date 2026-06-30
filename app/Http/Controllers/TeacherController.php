<?php

namespace App\Http\Controllers;

use App\Models\assign_subject_to_class;
use App\Models\AssignTeacherToClasses;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Services\PdfTeacherExport;
use App\Services\ExcelTeacherExport;


use function Laravel\Prompts\table;

class TeacherController extends Controller
{
    public function create()
    {
        return view('teachers/create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email|unique:teachers,email',
            'phone' => 'required|max:10',
            'qualification' => 'required',
            'specialization' => 'required',
            'experience' => 'required|numeric',
            'joining_date' => 'required',
            'gender' => 'required',
        ]);

        try {

            DB::transaction(function () use ($request) {

                $userId = DB::table('users')->insertGetId([
                    'name'       => $request->name,
                    'email'      => $request->email,
                    'password'   => Hash::make('password123'),
                    'role'       => '2',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $photoName = null;

                if ($request->hasFile('photo')) {
                    $photo = $request->photo;
                    $photoName = time() . '.' . $photo->getClientOriginalExtension();
                    $photo->move(public_path('uploads/teachers'), $photoName);
                }

                Teacher::create([
                    'user_id' => $userId,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'qualification' => $request->qualification,
                    'specialization' => $request->specialization,
                    'experience' => $request->experience,
                    'joining_date' => $request->joining_date,
                    'gender' => $request->gender,
                    'photo' => $photoName,
                    'address' => $request->address,
                ]);
            });

            return redirect()
                ->route('teachers.index')
                ->with('success', 'Teacher Added Successfully');
        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }


    public function index()
    {

        $search = request('table_search');
        $teachers = Teacher::where('name', 'like', '%' . $search . '%')->paginate(10);
        return view('teachers.index', compact('teachers'));
    }

    public function edit(teacher $teacher)
    {

        return view('teachers.edit', compact('teacher'));
    }

    public function profile()
    {
        $teacher = Teacher::where('user_id', auth()->id())
            ->firstOrFail();

        return view('teachers.profile', compact('teacher'));
    }



    public function myAssignment()
    {

        $assignments = DB::table('assign_teacher_to_classes')
            ->join('teachers', 'teachers.id', '=', 'assign_teacher_to_classes.teacher_id')
            ->join('school_class', 'school_class.id', '=', 'assign_teacher_to_classes.class_id')
            ->join('subjects', 'subjects.id', '=', 'assign_teacher_to_classes.subject_id')
            ->select(
                'teachers.name as teacher_name',
                'school_class.class_name as class_name',
                'subjects.subject_name as subject_name'
            )
            ->get();

        // dd($assignments);
        // $assignments = AssignTeacherToClasses::with([
        //     'teacher',
        //     'classroom',
        //     'subject'
        // ])->get();
        // // dd($assignments);
        return view('teachers.my-assignment', compact('assignments'));
    }

    //with relationship
    // public function myStudents()
    // {
    //     // dd('hello');
    //     $teacher = Teacher::where('user_id', auth()->id())
    //         ->firstOrFail();

    //     $classIds = $teacher->classes->pluck('id');

    //     $students = Student::whereIn('class', $classIds)
    //         ->get();
    //     //   dd($students);
    //     return view('teachers.my-students', compact('students'));
    // }
    //without relationship with manual joins

    public function myStudents()
    {
        $teacher = Teacher::where('user_id', auth()->id())
            ->firstOrFail();

        $classIds = $teacher->classes->pluck('id');

        $students = Student::join(
            'school_class',
            'school_class.id',
            '=',
            'students.class'
        )->whereIn('students.class', $classIds)->select('students.*', 'school_class.class_name')->get();

        return view('teachers.my-students', compact('students'));
    }

    public function exportTeachers($type)
    {
        if ($type == 'pdf') {
            $export = new PdfTeacherExport();
        } elseif ($type == 'excel') {
            $export = new ExcelTeacherExport();
        } else {
            abort(404, 'Invalid export type.');
        }

        return $export->export();
    }
}
