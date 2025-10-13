<?php

namespace App\Filament\Resources\Associations;

use App\Filament\Resources\Associations\Pages\CreateAssociation;
use App\Filament\Resources\Associations\Pages\EditAssociation;
use App\Filament\Resources\Associations\Pages\ListAssociations;
use App\Filament\Resources\Associations\Pages\ViewAssociation;
use App\Filament\Resources\Associations\Schemas\AssociationForm;
use App\Filament\Resources\Associations\Schemas\AssociationInfolist;
use App\Filament\Resources\Associations\Tables\AssociationsTable;
use App\Models\Association;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AssociationResource extends Resource
{
    protected static ?string $model = Association::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingLibrary;

    public static function getNavigationLabel(): string
    {
        return __('associations.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('associations.mainTitle');
    }

    public static function getModelLabel(): string
    {
        return __('resources.associations');
    }

    public static function canAccess(): bool
    {
        return auth()->user()->isHeadmaster();
    }

    public static function form(Schema $schema): Schema
    {
        return AssociationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AssociationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AssociationsTable::configure($table);
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
            'index' => ListAssociations::route('/'),
            'create' => CreateAssociation::route('/create'),
            'view' => ViewAssociation::route('/{record}'),
            'edit' => EditAssociation::route('/{record}/edit'),
        ];
    }
}
