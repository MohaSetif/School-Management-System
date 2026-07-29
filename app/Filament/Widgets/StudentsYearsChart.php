<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class StudentsYearsChart extends ChartWidget
{
    protected ?string $heading = null;
    public ?string $filter = null;

    public function getHeading(): string
    {
        return __('students.academic_years_stats');
    }

    protected function getFilters(): ?array
    {
        // Use a cross-database compatible expression
        $driver = DB::getDriverName();
        $yearExpression = $driver === 'sqlite'
            ? "strftime('%Y', created_at)"
            : "YEAR(created_at)";

        $years = Student::select(DB::raw("$yearExpression as year"))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->filter() // remove nulls
            ->mapWithKeys(fn($year) => [$year => "{$year}/" . ($year + 1)])
            ->toArray();

        // Add "All" option
        return ['all' => __('students.all_years')] + $years;
    }

    protected function getData(): array
    {
        // Use the ACTUAL values stored in the database for academic_year
        $yearValues = ['first_year', 'second_year', 'third_year', 'fourth_year', 'fifth_year'];
        
        // These are for display labels
        $labels = [
            __('students.first_year'),
            __('students.second_year'),
            __('students.third_year'),
            __('students.fourth_year'),
            __('students.fifth_year'),
        ];

        $query = Student::query();

        // Apply filter (year)
        if ($this->filter && $this->filter !== 'all') {
            $driver = DB::getDriverName();
            $yearExpression = $driver === 'sqlite'
                ? "strftime('%Y', created_at)"
                : "YEAR(created_at)";
                    
            $query->whereRaw("$yearExpression = ?", [$this->filter]);
        }

        // Count males & females per academic level
        $maleCounts = [];
        $femaleCounts = [];

        foreach ($yearValues as $year) {
            $maleCounts[] = (clone $query)
                ->where('academic_year', $year)
                ->where('gender', 'male')
                ->count();
                
            $femaleCounts[] = (clone $query)
                ->where('academic_year', $year)
                ->where('gender', 'female')
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => __('students.fields.genders.male'),
                    'data' => $maleCounts,
                    'backgroundColor' => '#3b82f6',
                ],
                [
                    'label' => __('students.fields.genders.female'),
                    'data' => $femaleCounts,
                    'backgroundColor' => '#ec4899',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}