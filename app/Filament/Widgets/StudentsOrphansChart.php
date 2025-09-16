<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Widgets\ChartWidget;

class StudentsOrphansChart extends ChartWidget
{
    protected ?string $heading = null;

    public function getHeading(): string
    {
        return __('students.orphans_stats');
    }

    protected function getData(): array
    {
        $orphans = Student::where('is_orphan', true)->count();
        $nonOrphans = Student::where('is_orphan', false)->count();

        return [
            'datasets' => [
                [
                    'data' => [$orphans, $nonOrphans],
                    'backgroundColor' => [
                        '#f97316', // orange for orphans
                        '#3b82f6', // blue for non-orphans
                    ],
                ],
            ],
            'labels' => [
                __('students.fields.is_orphan'),        // Orphans
                __('students.fields.not_orphan'),      // Non-Orphans (add to lang file)
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
