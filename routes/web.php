<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Teacher;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {

        $studentCount = Student::count();
        $teacherCount = Teacher::count();
        //  dd($studentCount);
        return view('dashboard', compact(
            'studentCount',
            'teacherCount'
        ));
    })->middleware('auth')->name('dashboard');
    // Route::get('dashboard',)->middleware(['auth']);
    // Route::get('/dashboard', function () {
    //     dd(session('permissions'));
    // })->middleware(['auth']);
    // Route::resource('students', StudentController::class)->except(['show']);;
    // Route::resource('teachers', TeacherController::class)->except(['show']);;
    Route::get('/dashboard-counts', function () {
        return response()->json([
            'students' => Student::count(),
            'teachers' => Teacher::count(),
        ]);
    })->name('dashboard.count');



    Route::middleware(['auth', 'permission'])->group(function () {

        Route::get('students', [StudentController::class, 'index'])->name('students.index');

        Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
        Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');

        Route::get('students/{student}/edit', [StudentController::class, 'edit'])
            ->name('students.edit');
        Route::get('/students/update', [StudentController::class, 'update'])->name('students.update');

        Route::get('/students/destroy', [StudentController::class, 'create'])->name('students.destroy');
        Route::get('/students/my-subjects', [StudentController::class, 'mySubjects'])->name('students.subject');





        Route::get('teachers', [TeacherController::class, 'index'])->name('teachers.index');
        Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
        Route::post('/teachers/store', [TeacherController::class, 'store'])->name('teachers.store');

        Route::get('/teachers/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
        Route::get('/teachers/update', [TeacherController::class, 'update'])->name('teachers.update');

        Route::get('/teachers/destroy', [TeacherController::class, 'destroy'])->name('teachers.destroy');

        Route::get('/teacher/profile', [TeacherController::class, 'profile'])->name('teacher.profile');
        Route::get('/teacher/my-assign', [TeacherController::class, 'myAssignment'])->name('teacher.assign');
        Route::get('/teacher/my-students', [TeacherController::class, 'myStudents'])->name('teacher.students');

        Route::get('/teacher/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::post(
            '/teacher/attendance/store',
            [AttendanceController::class, 'store']
        )->name('attendance.store');



        // Route::get('/attendance', [AttendanceController::class, 'index']);
    });








    Route::get('/force-logout', function () {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return 'Logged Out Successfully';
    });

    // Route::get('students', [StudentController::class, 'studentForm'])->name('student.add');
    // Route::post('students', [StudentController::class, 'studentStore']);
    // Route::get('get-students', [StudentController::class, 'showStudent'])->name('student.show');
    // Route::get('edit-students', [StudentController::class, 'editStudent'])->name('student.edit');
});
Route::get(
    '/students/export/{type}',
    [StudentController::class, 'exportStudents']
);
Route::get(
    '/teachers/export/{type}',
    [TeacherController::class, 'exportTeachers']
);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
