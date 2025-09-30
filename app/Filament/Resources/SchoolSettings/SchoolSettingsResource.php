<?php

namespace App\Filament\Resources\SchoolSettings;

use App\Filament\Resources\SchoolSettings\Pages\CreateSchoolSettings;
use App\Filament\Resources\SchoolSettings\Pages\EditSchoolSettings;
use App\Filament\Resources\SchoolSettings\Pages\ListSchoolSettings;
use App\Filament\Resources\SchoolSettings\Pages\ViewSchoolSettings;
use App\Filament\Resources\SchoolSettings\Schemas\SchoolSettingsForm;
use App\Filament\Resources\SchoolSettings\Schemas\SchoolSettingsInfolist;
use App\Filament\Resources\SchoolSettings\Tables\SchoolSettingsTable;
use App\Models\SchoolSettings;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SchoolSettingsResource extends Resource
{
    protected static ?string $model = SchoolSettings::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::InformationCircle;

    public static function getNavigationLabel(): string
    {
        return __('school_settings.label');
    }

    public static function getNavigationTitle(): string
    {
        return __('school_settings.title');
    }

    public static function form(Schema $schema): Schema
    {
        return SchoolSettingsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SchoolSettingsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SchoolSettingsTable::configure($table);
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
            'index' => ListSchoolSettings::route('/'),
            'create' => CreateSchoolSettings::route('/create'),
            'view' => ViewSchoolSettings::route('/{record}'),
            'edit' => EditSchoolSettings::route('/{record}/edit'),
        ];
    }
}
