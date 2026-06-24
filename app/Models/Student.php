<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public $fillable = ['name', 'user_id', 'email', 'phone', 'class', 'age', 'gender', 'address', 'photo'];



    public function schoolClass()
    {

        return $this->belongsTo(

            schoolClass::class,
            'class',      // foreign key in students table
            'id'          // primary key in school_class table
        );
    }
}
