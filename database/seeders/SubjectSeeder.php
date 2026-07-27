<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            ['name' => 'Mathematics', 'code' => 'MATH'],
            ['name' => 'Arabic', 'code' => 'AR'],
            ['name' => 'English', 'code' => 'ENG'],
            ['name' => 'Natural Science', 'code' => 'SCI'],
            ['name' => 'Physics', 'code' => 'PHY'],
            ['name' => 'History', 'code' => 'HIST'],
            ['name' => 'Geography', 'code' => 'GEO'],
            ['name' => 'Islamic Studies', 'code' => 'ISL'],
            ['name' => 'Computer Science', 'code' => 'CS'],
            ['name' => 'Physical Education', 'code' => 'PE'],
            ['name' => 'Art', 'code' => 'ART'],
            ['name' => 'Music', 'code' => 'MUS'],
            ['name' => 'French', 'code' => 'FR'],
        ];

        foreach ($subjects as $subject) {
            Subject::updateOrCreate(
                ['code' => $subject['code']],
                ['name' => $subject['name']]
            );
        }
    }
}