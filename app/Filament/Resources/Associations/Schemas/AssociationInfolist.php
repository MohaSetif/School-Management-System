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
                Section::make('معلومات الجمعية')
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('name')
                                ->label('اسم الجمعية')
                                ->weight('bold')
                                ->size('l'),

                            TextEntry::make('serial_number')
                                ->label('الرقم التسلسلي')
                                ->numeric()
                                ->formatStateUsing(fn($state) => self::toLatinNumbers($state))
                                ->badge()
                                ->color('info'),
                        ]),
                    ])
                    ->collapsible(),

                Section::make('معلومات الاتصال')
                    ->schema([
                        TextEntry::make('email')
                            ->label('البريد الإلكتروني')
                            ->icon('heroicon-o-envelope')
                            ->copyable(),
                    ])
                    ->collapsible(),

                Section::make('التواريخ')
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('establishment_date')
                                ->label('تاريخ التأسيس')
                                ->date()
                                ->formatStateUsing(fn($state) => self::toLatinNumbers(optional($state)->format('Y-m-d'))),

                            TextEntry::make('renew_date')
                                ->label('تاريخ التجديد')
                                ->date()
                                ->formatStateUsing(fn($state) => self::toLatinNumbers(optional($state)->format('Y-m-d'))),

                            TextEntry::make('created_at')
                                ->label('تاريخ الإضافة')
                                ->dateTime()
                                ->placeholder('-')
                                ->formatStateUsing(fn($state) => self::toLatinNumbers(optional($state)->format('Y-m-d H:i'))),

                            TextEntry::make('updated_at')
                                ->label('آخر تحديث')
                                ->dateTime()
                                ->placeholder('-')
                                ->formatStateUsing(fn($state) => self::toLatinNumbers(optional($state)->format('Y-m-d H:i'))),
                        ]),
                    ])
                    ->collapsible(),

                Section::make('الرصيد')
                    ->schema([
                        TextEntry::make('score')
                            ->label('النقاط')
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
