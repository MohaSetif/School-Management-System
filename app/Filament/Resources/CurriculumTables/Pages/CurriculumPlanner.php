<?php

namespace App\Filament\Resources\CurriculumTableResource\Pages;

use App\Filament\Resources\CurriculumTables\CurriculumTableResource;
use BackedEnum;
use Filament\Resources\Pages\Page;

class CurriculumPlanner extends Page
{
    protected static string $resource = CurriculumTableResource::class;

    protected string $view = 'filament.resources.curriculum-tables.pages.curriculum-planner';

    protected static ?string $title = 'Curriculum Planner';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Planner';

    protected static ?string $slug = 'curriculum-planner';

    public $record;

    public function mount($record)
    {
        $this->record = \App\Models\CurriculumTable::findOrFail($record);
    }
}
