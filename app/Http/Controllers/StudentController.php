<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Traits\LogTrait;
use App\Services\PdfStudentExport;
use App\Services\ExcelStudentExport;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    use LogTrait;
    public function create()
    {
        $classes = DB::table('school_class')
            ->where('status', 1)
            ->get();
        return view('students/create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email|unique:students,email',
            'class_id' => 'required',
            'phone'    => 'required|max:10',
        ]);

        try {

            DB::transaction(function () use ($request, &$students) {

                $userId = DB::table('users')->insertGetId([
                    'name'       => $request->name,
                    'email'      => $request->email,
                    'password'   => Hash::make('password123'),
                    'role'       => '3',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $photoName = null;

                if ($request->hasFile('photo')) {

                    $photo = $request->file('photo');

                    $photoName = time() . '.' .
                        $photo->getClientOriginalExtension();

                    $photo->move(
                        public_path('uploads'),
                        $photoName
                    );
                }

                $students = Student::create([
                    'user_id' => $userId,
                    'name' => $request->name,
                    'email' => $request->email,
                    'class' => $request->class_id,
                    'phone' => $request->phone,
                    'age' => $request->age,
                    'gender' => $request->gender,
                    'photo' => $photoName,
                    'address' => $request->address
                ]);
            });

            $this->writeLog(
                'Student Created: ' . $students->name
            );

            return redirect()
                ->route('students.index')
                ->with('success', 'Student Added Successfully');
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function index()
    {
        $search = request('table_search');
        // $students = Student::when($search, function ($query, $search) {
        //     return $query->where('name', 'like', '%' . $search . '%');
        // })->get();
        $user = auth()->user();
        if ($user->role == '1') {
            $students = $students = Student::with('schoolClass')->where('name', 'like', '%' . $search . '%')
                ->paginate(8);
            $this->writeLog(
                'Student searched by: ' . auth()->user()->name .
                    ' | Search: ' . $search
            );
        }
        if ($user->role == '2') {
            $teacher = Teacher::where('user_id', auth()->id())
                ->firstOrFail();

            $classIds = $teacher->classes->pluck('id');


            $students = Student::with('schoolClass')
                ->where('name', 'like', '%' . $search . '%')
                ->whereIn('class', $classIds)
                ->paginate(8);
        }
        return view('students.index', compact('students'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {

        $photoName = $student->photo;
        if ($request->hasFile('photo')) {

            if ($student->photo && file_exists(public_path('uploads/' . $student->photo))) {
                unlink(public_path('uploads/' . $student->photo));
            }

            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(
                public_path('uploads'),
                $photoName
            );
        }
        $student->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'class'  => $request->class_id,
            'age'     => $request->age,
            'gender'  => $request->gender,
            'address' => $request->address,
            'photo' => $photoName
        ]);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student updated successfully');
    }

    public function destroy(Student $student)
    {
        // $student already contains record with id=5

        $student->delete();

        return redirect()->route('students.index');
    }




    public function mySubjects()
    {
        $students = Student::where('user_id', auth()->id())->firstOrFail();
        // $classId=  $students->class;
        $subjects = DB::table('assign_teacher_to_classes')
            ->join('school_class', 'school_class.id', '=', 'assign_teacher_to_classes.class_id')
            ->join('subjects', 'subjects.id', '=', 'assign_teacher_to_classes.subject_id')
            ->join('teachers', 'teachers.id', '=', 'assign_teacher_to_classes.teacher_id')

            ->where('assign_teacher_to_classes.class_id', $students->class)
            ->select('school_class.class_name', 'subjects.subject_name', 'teachers.name')->get();
        // dd($subjects);
        return view('students.mySubjects', compact('subjects'));
    }











    public function exportStudents($type)
    {
        if ($type == 'pdf') {
            $export = new PdfStudentExport();
        } elseif ($type == 'excel') {
            $export = new ExcelStudentExport();
        } else {
            abort(404, 'Invalid export type.');
        }

        return $export->export();
    }
}
