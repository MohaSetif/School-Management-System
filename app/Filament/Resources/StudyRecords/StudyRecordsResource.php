<?php

namespace App\Filament\Resources\StudyRecords;

use App\Filament\Resources\StudyRecords\Pages\CreateStudyRecords;
use App\Filament\Resources\StudyRecords\Pages\EditStudyRecords;
use App\Filament\Resources\StudyRecords\Pages\ListStudyRecords;
use App\Filament\Resources\StudyRecords\Pages\ViewStudyRecords;
use App\Filament\Resources\StudyRecords\Schemas\StudyRecordsForm;
use App\Filament\Resources\StudyRecords\Schemas\StudyRecordsInfolist;
use App\Filament\Resources\StudyRecords\Tables\StudyRecordsTable;
use App\Models\StudyRecords;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StudyRecordsResource extends Resource
{
    protected static ?string $model = StudyRecords::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return StudyRecordsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return StudyRecordsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StudyRecordsTable::configure($table);
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
            'index' => ListStudyRecords::route('/'),
            'create' => CreateStudyRecords::route('/create'),
            'view' => ViewStudyRecords::route('/{record}'),
            'edit' => EditStudyRecords::route('/{record}/edit'),
        ];
    }
}
