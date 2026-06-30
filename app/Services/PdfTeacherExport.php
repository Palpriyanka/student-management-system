<?php

namespace App\Services;

use App\Interfaces\StudentExportInterface;
use App\Models\Teacher;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfTeacherExport implements StudentExportInterface
{
    public function export()
    {
        $teachers = Teacher::all();

        $pdf = Pdf::loadView('teachers.pdf', compact('teachers'));

        return $pdf->download('teachers.pdf');
    }
}
