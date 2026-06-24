<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    public $fillable = ['name', 'user_id', 'email', 'phone', 'qualification', 'specialization', 'experience', 'joining_date', 'gender', 'photo', 'address', 'status'];

    public function classes()
    {
        return $this->belongsToMany(
            SchoolClass::class,
            'assign_teacher_to_classes',
            'teacher_id',
            'class_id'
        );
    }
}
