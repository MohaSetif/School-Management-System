<?php

namespace App\Filament\Resources\AcademicMembers\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;

class AcademicMemberInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make(__('academic_members.sections.personal_info'))
                ->columns(2)
                ->heading(fn () => __('academic_members.sections.personal_info'))
                ->icon('heroicon-o-user')
                ->collapsible()
                ->schema([
                    TextEntry::make('last_name')
                        ->label(__('academic_members.fields.last_name'))
                        ->placeholder('-')
                        ->color(Color::Blue)
                        ->weight('bold')
                        ->size('lg'),

                    TextEntry::make('first_name')
                        ->label(__('academic_members.fields.first_name'))
                        ->placeholder('-')
                        ->color(Color::Blue)
                        ->weight('bold')
                        ->size('lg'),

                    TextEntry::make('phone')
                        ->label(__('academic_members.fields.phone'))
                        ->placeholder('-')
                        ->icon('heroicon-o-phone')
                        ->color(Color::Gray),

                    TextEntry::make('postal_account_number')
                        ->label(__('academic_members.fields.postal_account_number'))
                        ->placeholder('-')
                        ->icon('heroicon-o-credit-card')
                        ->color(Color::Gray),

                    TextEntry::make('postal_account')
                        ->label(__('academic_members.fields.postal_account'))
                        ->placeholder('-')
                        ->icon('heroicon-o-building-library')
                        ->color(Color::Gray),

                    TextEntry::make('email')
                        ->label(__('academic_members.fields.email'))
                        ->placeholder('-')
                        ->weight('bold')
                        ->size('lg'),

                    ImageEntry::make('image')
                        ->disk('public')
                        ->imageHeight(200)
                        ->label(__('academic_members.fields.image'))
                ]),

            Section::make(__('academic_members.sections.professional_info'))
                ->columns(2)
                ->heading(fn () => __('academic_members.sections.professional_info'))
                ->icon('heroicon-o-briefcase')
                ->collapsible()
                ->schema([
                    TextEntry::make('rank')
                        ->label(__('academic_members.fields.rank'))
                        ->placeholder('-')
                        ->badge()
                        ->color(Color::Green),

                    TextEntry::make('subject')
                        ->label(__('academic_members.fields.subject'))
                        ->placeholder('-')
                        ->color(Color::Indigo),

                    TextEntry::make('grade')
                        ->label(__('academic_members.fields.grade'))
                        ->placeholder('-')
                        ->badge()
                        ->color(Color::Yellow),
                ]),

            Section::make(__('academic_members.sections.appointment'))
                ->columns(2)
                ->heading(fn () => __('academic_members.sections.appointment'))
                ->icon('heroicon-o-calendar')
                ->collapsible()
                ->schema([
                    TextEntry::make('appointment_reference_number')
                        ->label(__('academic_members.fields.appointment_reference_number'))
                        ->placeholder('-')
                        ->icon('heroicon-o-document-text'),

                    TextEntry::make('appointment_reference_date')
                        ->label(__('academic_members.fields.appointment_reference_date'))
                        ->date()
                        ->placeholder('-')
                        ->color(Color::Gray),

                    TextEntry::make('appointment_date')
                        ->label(__('academic_members.fields.appointment_date'))
                        ->date()
                        ->placeholder('-')
                        ->color(Color::Gray),
                ]),

            Section::make(__('academic_members.sections.confirmation'))
                ->columns(2)
                ->heading(fn () => __('academic_members.sections.confirmation'))
                ->icon('heroicon-o-check-circle')
                ->collapsible()
                ->schema([
                    TextEntry::make('confirmation_reference_number')
                        ->label(__('academic_members.fields.confirmation_reference_number'))
                        ->placeholder('-')
                        ->icon('heroicon-o-document-check'),

                    TextEntry::make('confirmation_reference_date')
                        ->label(__('academic_members.fields.confirmation_reference_date'))
                        ->date()
                        ->placeholder('-')
                        ->color(Color::Gray),
                ]),

            Section::make(__('academic_members.sections.promotion'))
                ->columns(2)
                ->heading(fn () => __('academic_members.sections.promotion'))
                ->icon('heroicon-o-arrow-trending-up')
                ->collapsible()
                ->schema([
                    TextEntry::make('promotion_reference_number')
                        ->label(__('academic_members.fields.promotion_reference_number'))
                        ->placeholder('-')
                        ->icon('heroicon-o-document-plus'),

                    TextEntry::make('promotion_reference_date')
                        ->label(__('academic_members.fields.promotion_reference_date'))
                        ->date()
                        ->placeholder('-')
                        ->color(Color::Gray),

                    TextEntry::make('promotion_start_date')
                        ->label(__('academic_members.fields.promotion_start_date'))
                        ->date()
                        ->placeholder('-')
                        ->color(Color::Gray),

                    TextEntry::make('effective_date')
                        ->label(__('academic_members.fields.effective_date'))
                        ->date()
                        ->placeholder('-')
                        ->color(Color::Gray),
                ]),
        ]);
    }
}
