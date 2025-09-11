<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $groups = Group::all();

        foreach ($groups as $group) {
            // Create 15-25 students per group
            $studentCount = rand(15, 25);
            
            for ($i = 1; $i <= $studentCount; $i++) {
                $firstName = $faker->firstName;
                $lastName = $faker->lastName;
                
                Student::create([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'student_id' => $group->code . sprintf('%03d', $i),
                    'date_of_birth' => $faker->dateTimeBetween('-12 years', '-6 years'),
                    'address' => $faker->address,
                    'parent_name' => $faker->name,
                    'parent_phone' => $faker->phoneNumber,
                    'group_id' => $group->id,
                    'is_active' => true,
                ]);
            }
        }
    }
}
