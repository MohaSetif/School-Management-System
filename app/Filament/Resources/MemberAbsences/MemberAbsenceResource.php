<?php

namespace App\Filament\Resources\MemberAbsences;

use App\Filament\Resources\MemberAbsences\Pages\CreateMemberAbsence;
use App\Filament\Resources\MemberAbsences\Pages\EditMemberAbsence;
use App\Filament\Resources\MemberAbsences\Pages\ListMemberAbsences;
use App\Filament\Resources\MemberAbsences\Pages\ViewMemberAbsence;
use App\Filament\Resources\MemberAbsences\Schemas\MemberAbsenceForm;
use App\Filament\Resources\MemberAbsences\Schemas\MemberAbsenceInfolist;
use App\Filament\Resources\MemberAbsences\Tables\MemberAbsencesTable;
use App\Models\MemberAbsence;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MemberAbsenceResource extends Resource
{
    protected static ?string $model = MemberAbsence::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserMinus;

    public static function getNavigationLabel(): string
    {
        return __('members_absence.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('members_absence.navigation.group');
    }

    public static function getPluralModelLabel(): string
    {
        return __('members_absence.mainTitle');
    }

    public static function form(Schema $schema): Schema
    {
        return MemberAbsenceForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MemberAbsenceInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MemberAbsencesTable::configure($table);
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
            'index' => ListMemberAbsences::route('/'),
            'create' => CreateMemberAbsence::route('/create'),
            'view' => ViewMemberAbsence::route('/{record}'),
            'edit' => EditMemberAbsence::route('/{record}/edit'),
        ];
    }
}
