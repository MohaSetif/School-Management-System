<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            ['name' => '1st year', 'code' => 1, 'description' => 'First grade'],
            ['name' => '2nd year', 'code' => 1, 'description' => 'Second grade'],
            ['name' => '3rd year', 'code' => 1, 'description' => 'Third grade'],
            ['name' => '5th year', 'code' => 1, 'description' => 'Fifth grade'],
        ];

        $teachers = User::where('role', 'teacher')->get();

        foreach ($groups as $index => $groupData) {
            $group = Group::create($groupData);
            
            // Assign teachers to groups (each group gets at least one teacher)
            $teacherIndex = $index % $teachers->count();
            $group->teachers()->attach($teachers[$teacherIndex]->id);
            
            // Some groups might have additional teachers
            if ($index < 2) {
                $additionalTeacherIndex = ($index + 1) % $teachers->count();
                if ($additionalTeacherIndex !== $teacherIndex) {
                    $group->teachers()->attach($teachers[$additionalTeacherIndex]->id);
                }
            }
        }
    }
}
