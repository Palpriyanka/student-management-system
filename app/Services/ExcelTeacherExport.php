<?php

namespace App\Services;

use App\Exports\TeachersExport;
use App\Interfaces\StudentExportInterface;
use Maatwebsite\Excel\Facades\Excel;

class ExcelTeacherExport implements StudentExportInterface
{
    public function export()
    {
        return Excel::download(new TeachersExport(), 'teachers.xlsx');
    }
}
