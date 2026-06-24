<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;
    protected $table = 'school_class';
    protected $fillable = [
        'class_name',
        'status'
    ];
    public function students()
    {
        return $this->hasMany(
            Student::class,
            'class_id',
            'id'
        );
    }

    public function teachers()
    {
        return $this->belongsToMany(
            Teacher::class,
            'assign_teacher_to_classes',
            'class_id',
            'teacher_id'
        );
    }
}
