<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Widgets\ChartWidget;

class StudentsGendersChart extends ChartWidget
{
    // ✅ Make it non-static and set in getHeading()
    protected ?string $heading = null;

    public function getHeading(): string
    {
        return __('students.stats');
    }

    protected function getData(): array
    {
        $maleCount = Student::where('gender', 'male')->count();
        $femaleCount = Student::where('gender', 'female')->count();

        return [
            'datasets' => [
                [
                    'data' => [$maleCount, $femaleCount],
                    'backgroundColor' => [
                        '#3b82f6', // blue for male
                        '#ec4899', // pink for female
                    ],
                ],
            ],
            'labels' => [
                __('students.fields.genders.male'),
                __('students.fields.genders.female'),
            ],
        ];
    }

    protected function getType(): string
    {
        return 'polarArea';
    }
}
