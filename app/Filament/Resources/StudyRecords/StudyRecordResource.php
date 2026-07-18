<?php

namespace App\Filament\Resources\StudyRecords;

use App\Filament\Resources\StudyRecords\Pages\CreateStudyRecord;
use App\Filament\Resources\StudyRecords\Pages\EditStudyRecord;
use App\Filament\Resources\StudyRecords\Pages\ListStudyRecords;
use App\Filament\Resources\StudyRecords\Pages\ViewStudyRecord;
use App\Filament\Resources\StudyRecords\Schemas\StudyRecordForm;
use App\Filament\Resources\StudyRecords\Schemas\StudyRecordInfolist;
use App\Filament\Resources\StudyRecords\Tables\StudyRecordsTable;
use App\Models\StudyRecord;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StudyRecordResource extends Resource
{
    protected static ?string $model = StudyRecord::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    public static function form(Schema $schema): Schema
    {
        return StudyRecordForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return StudyRecordInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StudyRecordsTable::configure($table);
    }

    public static function getNavigationLabel(): string
    {
        return __('studyrecord.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('studyrecord.navigation.group');
    }

    public static function getPluralModelLabel(): string
    {
        return __('studyrecord.mainTitle');
    }

    public static function getModelLabel(): string
    {
        return __('studyrecord.mainTitle');
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
            'create' => CreateStudyRecord::route('/create'),
            'view' => ViewStudyRecord::route('/{record}'),
            'edit' => EditStudyRecord::route('/{record}/edit'),
            'pdf' => Pages\StudyRecordPdf::route('/{record}/pdf'),
        ];
    }
}
