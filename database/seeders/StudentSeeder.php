<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $groups = Group::all();

        foreach ($groups as $group) {
            // Create 15–25 students per group
            $studentCount = rand(15, 25);

            for ($i = 1; $i <= $studentCount; $i++) {
                $gender = $faker->randomElement(['male', 'female']);
                $firstName = $faker->firstName($gender);
                $lastName = $faker->lastName;

                Student::create([
                    'student_identifier' => $faker->unique()->numberBetween(100000, 999999),
                    'first_name'         => $firstName,
                    'last_name'          => $lastName,
                    'gender'             => $gender,
                    'date_of_birth'      => $faker->dateTimeBetween('-12 years', '-6 years'),

                    // Birth details
                    'is_judicial_birth'      => $faker->boolean(5), // 5% chance
                    'has_birth_certificate'  => $faker->randomElement(['normal', 'lost', 'copy']),
                    'birth_registration_year'=> $faker->optional()->year(),
                    'birth_certificate_number'=> $faker->optional()->numerify('BC####'),
                    'place_of_birth'        => $faker->city(),

                    // School details
                    'academic_year'    => $faker->randomElement(['1st year', '2nd year', '3rd year', '4th year', '5th year']),
                    'group_id'         => $group->id,
                    'schooling_system' => $faker->randomElement(['public', 'private']),
                    'enrollment_number'=> $faker->numerify('ENR###'),
                    'enrollment_date'  => $faker->dateTimeBetween('-3 years', 'now'),

                    // Social status
                    'is_orphan'       => $faker->boolean(5),
                    'is_needy'        => $faker->boolean(10),
                    'health_status'   => $faker->optional()->randomElement(['healthy', 'disabled', 'chronic illness']),
                    'psychological_status' => $faker->optional()->randomElement(['stable', 'needs support']),
                    'is_sector_child' => $faker->boolean(3),

                    'is_active' => true,
                ]);
            }
        }
    }
}
