<?php

namespace App\Services;

use App\Interfaces\StudentExportInterface;
use App\Models\Student;

class ExcelStudentExport implements StudentExportInterface
{
    public function export()
    {
        $students = Student::all();

        return $students;
    }
}
