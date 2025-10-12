<?php

namespace App\Filament\Resources\AttendanceRecords;

use App\Filament\Resources\AttendanceRecords\Pages\CreateAttendanceRecord;
use App\Filament\Resources\AttendanceRecords\Pages\EditAttendanceRecord;
use App\Filament\Resources\AttendanceRecords\Pages\ListAttendanceRecords;
use App\Filament\Resources\AttendanceRecords\Pages\ViewAttendanceRecord;
use App\Filament\Resources\AttendanceRecords\Schemas\AttendanceRecordForm;
use App\Filament\Resources\AttendanceRecords\Schemas\AttendanceRecordInfolist;
use App\Filament\Resources\AttendanceRecords\Tables\AttendanceRecordsTable;
use App\Models\Attendance_record;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use UnitEnum;

class AttendanceRecordResource extends Resource
{
    protected static ?string $model = Attendance_record::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function getNavigationLabel(): string
    {
        return __('attendance.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('attendance.navigation.group');
    }

    public static function getPluralModelLabel(): string
    {
        return __('attendance.mainTitle');
    }

    public static function getModelLabel(): string
    {
        return __('resources.attendance');
    }

    public static function form(Schema $schema): Schema
    {
        return AttendanceRecordForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AttendanceRecordInfolist::configure($schema);
    }

    public static function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return AttendanceRecordsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListAttendanceRecords::route('/'),
            'create' => CreateAttendanceRecord::route('/create'),
            'view'   => ViewAttendanceRecord::route('/{record}'),
            'edit'   => EditAttendanceRecord::route('/{record}/edit'),
        ];
    }
}
