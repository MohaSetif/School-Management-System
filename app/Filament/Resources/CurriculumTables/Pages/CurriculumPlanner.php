<?php

namespace App\Filament\Resources\CurriculumTableResource\Pages;

use App\Filament\Resources\CurriculumTables\CurriculumTableResource;
use Filament\Resources\Pages\Page;
use App\Models\CurriculumTable;

class CurriculumPlanner extends Page
{
    protected static string $resource = CurriculumTableResource::class;

    protected string $view = 'filament.resources.curriculum-tables.pages.curriculum-planner';

    protected static ?string $title = 'Monthly Curriculum Planner';

    protected static ?string $navigationLabel = 'Planner';

    protected static ?string $slug = 'curriculum-planner';

    public $month;
    public $records;

    public function mount()
    {
        // Example: Default to current month
        $this->month = request()->get('month', now()->format('Y-m'));

        $this->records = CurriculumTable::where('month', $this->month)
            ->with('user') // if teacher info needed
            ->get();
    }
}
