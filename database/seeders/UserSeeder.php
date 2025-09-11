<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Headmaster
        User::create([
            'name' => 'John Headmaster',
            'email' => 'headmaster@school.com',
            'password' => Hash::make('password'),
            'phone' => '+1234567890',
            'role' => 'headmaster',
            'is_active' => true,
        ]);

        // Create Teachers
        $teachers = [
            ['name' => 'Alice Johnson', 'email' => 'alice.johnson@school.com'],
            ['name' => 'Bob Smith', 'email' => 'bob.smith@school.com'],
            ['name' => 'Carol Davis', 'email' => 'carol.davis@school.com'],
            ['name' => 'David Wilson', 'email' => 'david.wilson@school.com'],
        ];

        foreach ($teachers as $teacher) {
            User::create([
                'name' => $teacher['name'],
                'email' => $teacher['email'],
                'password' => Hash::make('password'),
                'phone' => '+1234567890',
                'role' => 'teacher',
                'is_active' => true,
            ]);
        }

        // Create Employees
        $employees = [
            ['name' => 'Eva Martinez', 'email' => 'eva.martinez@school.com'],
            ['name' => 'Frank Brown', 'email' => 'frank.brown@school.com'],
        ];

        foreach ($employees as $employee) {
            User::create([
                'name' => $employee['name'],
                'email' => $employee['email'],
                'password' => Hash::make('password'),
                'phone' => '+1234567890',
                'role' => 'employee',
                'is_active' => true,
            ]);
        }
    }
}
