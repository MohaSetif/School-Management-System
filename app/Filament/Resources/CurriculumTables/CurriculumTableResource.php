<?php

namespace App\Filament\Resources\CurriculumTables;

use App\Filament\Resources\CurriculumTables\Pages\CreateCurriculumTable;
use App\Filament\Resources\CurriculumTables\Pages\EditCurriculumTable;
use App\Filament\Resources\CurriculumTables\Pages\ListCurriculumTables;
use App\Filament\Resources\CurriculumTables\Pages\ViewCurriculumTable;
use App\Filament\Resources\CurriculumTables\Schemas\CurriculumTableForm;
use App\Filament\Resources\CurriculumTables\Schemas\CurriculumTableInfolist;
use App\Filament\Resources\CurriculumTables\Tables\CurriculumTablesTable;
use App\Models\CurriculumTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CurriculumTableResource extends Resource
{
    protected static ?string $model = CurriculumTable::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return CurriculumTableForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CurriculumTableInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CurriculumTablesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCurriculumTables::route('/'),
            'create' => CreateCurriculumTable::route('/create'),
            'view' => ViewCurriculumTable::route('/{record}'),
            'edit' => EditCurriculumTable::route('/{record}/edit'),
        ];
    }
}
