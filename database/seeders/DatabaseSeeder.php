<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Default admin account
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'               => 'Administrator',
                'password'           => Hash::make('admin123'),
                'role'               => 'admin',
                'email_verified_at'  => now(),
            ]
        );

        // Seed subjects
        $subjects = [
            'Mathematics', 'Physics', 'Chemistry', 'Biology',
            'Geography', 'History', 'English', 'Kiswahili',
            'Commerce', 'Accounting', 'Economics', 'Computer Science',
            'Fine Arts', 'Physical Education', 'Religious Studies',
        ];
        foreach ($subjects as $name) {
            Subject::firstOrCreate(['name' => $name]);
        }

        // Seed comprehensive formulas
        $this->call(FormulaSeeder::class);
    }
}
