<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Widgets\ChartWidget;

class StudentsNeedyChart extends ChartWidget
{
    protected ?string $heading = null;

    public function getHeading(): string
    {
        return __('students.needy_stats');
    }

    protected function getData(): array
    {
        $needy = Student::where('is_needy', true)->count();
        $notNeedy = Student::where('is_needy', false)->count();

        return [
            'datasets' => [
                [
                    'data' => [$needy, $notNeedy],
                    'backgroundColor' => [
                        '#10b981', // green for needy
                        '#9ca3af', // gray for non-needy
                    ],
                ],
            ],
            'labels' => [
                __('students.fields.is_needy'),        // Needy
                __('students.fields.not_needy'),      // Not Needy (add to lang file)
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
