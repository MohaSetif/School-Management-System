<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Widgets\ChartWidget;

class StudentsYearsChart extends ChartWidget
{
    protected ?string $heading = null;

    public function getHeading(): string
    {
        return __('students.academic_years_stats');
    }

    protected function getData(): array
    {
        $years = ['أولى', 'ثانية', 'ثالثة', 'رابعة', 'خامسة'];

        // Count male and female students per year
        $maleCounts = [];
        $femaleCounts = [];

        foreach ($years as $year) {
            $maleCounts[] = Student::where('academic_year', $year)
                ->where('gender', 'male')
                ->count();

            $femaleCounts[] = Student::where('academic_year', $year)
                ->where('gender', 'female')
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => __('students.fields.genders.male'),
                    'data' => $maleCounts,
                    'backgroundColor' => '#3b82f6', // blue for males
                ],
                [
                    'label' => __('students.fields.genders.female'),
                    'data' => $femaleCounts,
                    'backgroundColor' => '#ec4899', // pink for females
                ],
            ],
            'labels' => [
                __('students.first_year'),
                __('students.second_year'),
                __('students.third_year'),
                __('students.fourth_year'),
                __('students.fifth_year'),
            ]
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // grouped bar chart
    }
}
