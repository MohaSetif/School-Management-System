<?php

namespace App\Filament\Resources\AcademicMembers;

use App\Filament\Resources\AcademicMembers\Pages\CreateAcademicMember;
use App\Filament\Resources\AcademicMembers\Pages\EditAcademicMember;
use App\Filament\Resources\AcademicMembers\Pages\ListAcademicMembers;
use App\Filament\Resources\AcademicMembers\Pages\ViewAcademicMember;
use App\Filament\Resources\AcademicMembers\Schemas\AcademicMemberForm;
use App\Filament\Resources\AcademicMembers\Schemas\AcademicMemberInfolist;
use App\Filament\Resources\AcademicMembers\Tables\AcademicMembersTable;
use App\Models\AcademicMember;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AcademicMemberResource extends Resource
{
    protected static ?string $model = AcademicMember::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-users';

    public static function getNavigationLabel(): string
    {
        return __('academic_members.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('academic_members.navigation.group');
    }

    public static function getModelLabel(): string
    {
        return __('resources.academic_members');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources.academic_members');
    }

    public static function form(Schema $schema): Schema
    {
        return AcademicMemberForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AcademicMemberInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AcademicMembersTable::configure($table);
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
            'index' => ListAcademicMembers::route('/'),
            'create' => CreateAcademicMember::route('/create'),
            'view' => ViewAcademicMember::route('/{record}'),
            'edit' => EditAcademicMember::route('/{record}/edit'),
        ];
    }
}
