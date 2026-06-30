<?php

namespace App\Services;

use App\Interfaces\StudentExportInterface;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfStudentExport implements StudentExportInterface
{
    public function export()
    {
        $students = Student::all();

        $pdf = Pdf::loadView('students.pdf', compact('students'));

        return $pdf->download('students.pdf');
    }
}
