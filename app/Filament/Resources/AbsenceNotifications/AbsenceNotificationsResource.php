<?php

namespace App\Filament\Resources\AbsenceNotifications;

use App\Filament\Resources\AbsenceNotifications\Pages\CreateAbsenceNotifications;
use App\Filament\Resources\AbsenceNotifications\Pages\EditAbsenceNotifications;
use App\Filament\Resources\AbsenceNotifications\Pages\ListAbsenceNotifications;
use App\Filament\Resources\AbsenceNotifications\Pages\ViewAbsenceNotifications;
use App\Filament\Resources\AbsenceNotifications\Schemas\AbsenceNotificationsForm;
use App\Filament\Resources\AbsenceNotifications\Schemas\AbsenceNotificationsInfolist;
use App\Filament\Resources\AbsenceNotifications\Tables\AbsenceNotificationsTable;
use App\Models\AbsenceNotification;
use App\Models\AbsenceNotifications;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AbsenceNotificationsResource extends Resource
{
    protected static ?string $model = AbsenceNotification::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-bell-alert';
    
    public static function getNavigationLabel(): string
    {
        return __('absence_notifications.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('absence_notifications.navigation.group');
    }

    public static function getPluralModelLabel(): string
    {
        return __('absence_notifications.mainTitle');
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) AbsenceNotification::where('notified', false)->count();
    }

    public static function form(Schema $schema): Schema
    {
        return AbsenceNotificationsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AbsenceNotificationsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AbsenceNotificationsTable::configure($table);
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
            'index' => ListAbsenceNotifications::route('/'),
            'create' => CreateAbsenceNotifications::route('/create'),
            'view' => ViewAbsenceNotifications::route('/{record}'),
            'edit' => EditAbsenceNotifications::route('/{record}/edit'),
        ];
    }
}
