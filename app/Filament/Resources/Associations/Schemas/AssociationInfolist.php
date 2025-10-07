<?php

namespace App\Filament\Resources\Associations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AssociationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('associations.sections.association_info'))
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('name')
                                ->label(__('associations.fields.name'))
                                ->weight('bold')
                                ->size('l'),

                            TextEntry::make('serial_number')
                                ->label(__('associations.fields.serial_number'))
                                ->numeric()
                                ->formatStateUsing(fn($state) => self::toLatinNumbers($state))
                                ->badge()
                                ->color('info'),
                        ]),
                    ])
                    ->collapsible(),

                Section::make(__('associations.sections.contact_info'))
                    ->schema([
                        TextEntry::make('email')
                            ->label(__('associations.fields.email'))
                            ->icon('heroicon-o-envelope')
                            ->copyable(),
                    ])
                    ->collapsible(),

                Section::make(__('associations.sections.dates'))
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('establishment_date')
                                ->label(__('associations.fields.establishment_date'))
                                ->date()
                                ->formatStateUsing(fn($state) => self::toLatinNumbers(optional($state)->format('Y-m-d'))),

                            TextEntry::make('renew_date')
                                ->label(__('associations.fields.renew_date'))
                                ->date()
                                ->formatStateUsing(fn($state) => self::toLatinNumbers(optional($state)->format('Y-m-d'))),

                            TextEntry::make('created_at')
                                ->label(__('associations.fields.created_at'))
                                ->dateTime()
                                ->placeholder('-')
                                ->formatStateUsing(fn($state) => self::toLatinNumbers(optional($state)->format('Y-m-d H:i'))),

                            TextEntry::make('updated_at')
                                ->label(__('associations.fields.updated_at'))
                                ->dateTime()
                                ->placeholder('-')
                                ->formatStateUsing(fn($state) => self::toLatinNumbers(optional($state)->format('Y-m-d H:i'))),
                        ]),
                    ])
                    ->collapsible(),

                Section::make(__('associations.sections.balance'))
                    ->schema([
                        TextEntry::make('score')
                            ->label(__('associations.fields.score'))
                            ->numeric()
                            ->formatStateUsing(fn($state) => self::toLatinNumbers($state))
                            ->badge()
                            ->color('success'),
                    ]),
            ]);
    }

    /**
     * Convert Arabic-Indic digits to Latin digits.
     */
    protected static function toLatinNumbers(?string $value): ?string
    {
        if (!$value) return $value;
        $arabic = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
        $latin  = ['0','1','2','3','4','5','6','7','8','9'];
        return str_replace($arabic, $latin, $value);
    }
}
