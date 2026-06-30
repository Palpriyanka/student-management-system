<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class StudentsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Student::select(
            'id',
            'name',
            'email',
            'phone',
            'class',
            'age',
            'gender',
            'address'
        )->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Class',
            'Age',
            'Gender',
            'Address',
        ];
    }
}
