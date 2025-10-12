<?php

namespace App\Filament\Resources\MyAbsences;

use App\Filament\Resources\MyAbsences\Pages\CreateMyAbsences;
use App\Filament\Resources\MyAbsences\Pages\EditMyAbsences;
use App\Filament\Resources\MyAbsences\Pages\ListMyAbsences;
use App\Filament\Resources\MyAbsences\Pages\ViewMyAbsences;
use App\Filament\Resources\MyAbsences\Schemas\MyAbsencesForm;
use App\Filament\Resources\MyAbsences\Schemas\MyAbsencesInfolist;
use App\Filament\Resources\MyAbsences\Tables\MyAbsencesTable;
use App\Models\MyAbsence;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MyAbsencesResource extends Resource
{
    protected static ?string $model = MyAbsence::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function getNavigationLabel(): string
    {
        return __('my_absences.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('my_absences.mainTitle');
    }

    public static function form(Schema $schema): Schema
    {
        return MyAbsencesForm::configure($schema);
    }

    public static function getModelLabel(): string
    {
        return __('resources.my_absences');
    }

    public static function infolist(Schema $schema): Schema
    {
        return MyAbsencesInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MyAbsencesTable::configure($table);
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
            'index' => ListMyAbsences::route('/'),
            'create' => CreateMyAbsences::route('/create'),
            'view' => ViewMyAbsences::route('/{record}'),
            'edit' => EditMyAbsences::route('/{record}/edit'),
        ];
    }
}
