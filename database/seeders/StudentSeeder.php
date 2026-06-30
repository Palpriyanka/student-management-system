<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 1; $i <= 10; $i++) {
            $userId = DB::table('users')->insertGetId([
                'name' => 'student' . $i,
                'email' => 'email' . $i . '@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('students')->insert(
                [
                    'user_id' => $userId,
                    'name' => 'Student ' . $i,
                    'email' => 'student' . $i . '@gmail.com',
                    'phone' => '98765432' . str_pad($i, 2, '0', STR_PAD_LEFT),
                    'class' => 1,
                    'age' => rand(18, 25),
                    'gender' => $i % 2 == 0 ? 'male' : 'female',
                    'address' => 'Demo Address ' . $i,
                    'photo' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
        // DB::table('students')->insert([

        //     [
        //         'name' => 'john',
        //         'email' => 'john@gmail.com',
        //         'phone' => '1231231231',
        //         'course' => 'btech',
        //         'age' => '21',
        //         'gender' => 'male',
        //         'address' => 'Mumbai',
        //         'photo' => '1779537964.jpeg'
        //     ],
        //     [
        //         'name' => 'johny',
        //         'email' => 'johny@gmail.com',
        //         'phone' => '1231231231',
        //         'course' => 'btech',
        //         'age' => '21',
        //         'gender' => 'female',
        //         'address' => 'Mumbai',
        //         'photo' => '1779537964.jpeg'
        //     ]



    }
}
