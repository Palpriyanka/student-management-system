<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->insert([

            [
                'name' => 'john',
                'email' => 'john@gmail.com',
                'phone' => '1231231231',
                'course' => 'btech',
                'age' => '21',
                'gender' => 'male',
                'address' => 'Mumbai',
                'photo' => '1779537964.jpeg'
            ],
            [
                'name' => 'johny',
                'email' => 'johny@gmail.com',
                'phone' => '1231231231',
                'course' => 'btech',
                'age' => '21',
                'gender' => 'female',
                'address' => 'Mumbai',
                'photo' => '1779537964.jpeg'
            ]


        ]);
    }
}
