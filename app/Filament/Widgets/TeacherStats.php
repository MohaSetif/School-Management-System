<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Filament\Widgets\ChartWidget;

class TeacherStats extends ChartWidget
{
    // ✅ Make it non-static and set in getHeading()
    protected ?string $heading = null;

    public function getHeading(): string
    {
        return __('academic_members.stats');
    }

    protected function getData(): array
    {
        $subjectCounts = Subject::withCount('teachers')->get();

        return [
            'datasets' => [
                [
                    'data' => $subjectCounts->pluck('teachers_count')->toArray(),
                    'backgroundColor' => [
                        '#3b82f6',
                        '#ec4899',
                        '#facc15',
                        '#10b981',
                        '#8b5cf6',
                        '#f97316',
                        '#14b8a6',
                        '#f43f5e',
                        '#eab308',
                        '#6366f1',
                        '#22d3ee',
                        '#db2777',
                        '#4ade80',
                        '#f472b6',
                    ],
                ],
            ],
            'labels' => $subjectCounts->keys()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
