<?php

namespace App\Filament\Resources\AbsenceNotifications;

use App\Filament\Resources\AbsenceNotifications\Pages\CreateAbsenceNotification;
use App\Filament\Resources\AbsenceNotifications\Pages\EditAbsenceNotification;
use App\Filament\Resources\AbsenceNotifications\Pages\ListAbsenceNotifications;
use App\Filament\Resources\AbsenceNotifications\Pages\ViewAbsenceNotification;
use App\Filament\Resources\AbsenceNotifications\Schemas\AbsenceNotificationForm;
use App\Filament\Resources\AbsenceNotifications\Schemas\AbsenceNotificationInfolist;
use App\Filament\Resources\AbsenceNotifications\Tables\AbsenceNotificationsTable;
use App\Models\Absence_notification;
use App\Models\AbsenceNotification;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class AbsenceNotificationResource extends Resource
{
    protected static ?string $model = Absence_notification::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-exclamation-triangle';
    protected static string|null $navigationLabel = 'Absence Alerts';
    protected static string|UnitEnum|null $navigationGroup = 'Reports';
    protected static string|BackedEnum|null $navigationBadge = null;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('notified', true)
            ->whereDate('created_at', today())
            ->count();
    }

    public static function form(Schema $schema): Schema
    {
        return AbsenceNotificationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AbsenceNotificationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AbsenceNotificationsTable::configure($table);
    }

     public static function canCreate(): bool
    {
        return false; // These are created automatically
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();

        if ($user->isHeadmaster()) {
            return parent::getEloquentQuery();
        }

        return parent::getEloquentQuery()->whereHas('student', function ($query) {
            $query->where('id', 0);
        });
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
            'create' => CreateAbsenceNotification::route('/create'),
            'view' => ViewAbsenceNotification::route('/{record}'),
            'edit' => EditAbsenceNotification::route('/{record}/edit'),
        ];
    }
}
