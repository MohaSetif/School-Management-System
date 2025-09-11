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
            ['name' => 'Grade 1A', 'code' => 'G1A', 'description' => 'First grade section A'],
            ['name' => 'Grade 1B', 'code' => 'G1B', 'description' => 'First grade section B'],
            ['name' => 'Grade 2A', 'code' => 'G2A', 'description' => 'Second grade section A'],
            ['name' => 'Grade 3A', 'code' => 'G3A', 'description' => 'Third grade section A'],
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
