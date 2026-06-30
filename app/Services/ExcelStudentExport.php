<?php

namespace App\Services;

use App\Exports\StudentsExport;
use App\Interfaces\StudentExportInterface;
use Maatwebsite\Excel\Facades\Excel;

class ExcelStudentExport implements StudentExportInterface
{
    public function export()
    {
        return Excel::download(new StudentsExport(), 'students.xlsx');
    }
}
