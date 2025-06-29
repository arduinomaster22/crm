<?php

namespace Backstage\Crm\Filament\Resources\ContactMoments\Schemas;

use BackedEnum;
use Backstage\Crm\Filament\Resources\ContactMoments\ContactMomentResource;
use Backstage\Crm\Models\Department;
use Backstage\Crm\Models\Organization;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Carbon;

class ContactMomentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                    ->columns(9)
                    ->schema([
                        Section::make(__('Contact Moment'))
                            ->icon(fn (): BackedEnum => ContactMomentResource::getNavigationIcon())
                            ->schema([
                                TextInput::make('subject')
                                    ->label(__('Subject'))
                                    ->required()
                                    ->maxLength(255)
                                    ->prefixIcon(fn (): BackedEnum => ContactMomentResource::getNavigationIcon())
                                    ->placeholder(__('Enter subject')),

                                RichEditor::make('body')
                                    ->label(__('Body'))
                                    ->required()
                                    ->placeholder(__('Enter body')),
                            ])
                            ->columnSpan(6),

                        Grid::make()
                            ->columns(1)
                            ->schema([
                                Section::make(__('Organization / Department'))
                                    ->icon(fn (): BackedEnum => Heroicon::OutlinedUser)
                                    ->schema([
                                        MorphToSelect::make('contactable')
                                            ->label(__('Contactable'))
                                            ->types([
                                                MorphToSelect\Type::make(Department::class)
                                                    ->label(__('Department'))
                                                    ->titleAttribute('name'),

                                                MorphToSelect\Type::make(Organization::class)
                                                    ->label(__('Organization'))
                                                    ->titleAttribute('name'),
                                            ])
                                            ->native(false)
                                            ->preload()
                                            ->searchable()
                                            ->required(),
                                    ])
                                    ->columnSpanFull(),

                                Section::make(__('Date'))
                                    ->icon(fn (): BackedEnum => Heroicon::OutlinedCalendarDateRange)
                                    ->schema([
                                        DatePicker::make('contact_date')
                                            ->label(__('Contact Date'))
                                            ->required()
                                            ->native(false)
                                            ->prefixIcon(fn (): BackedEnum => Heroicon::OutlinedCalendarDateRange)
                                            ->default(fn (): Carbon => now())
                                            ->placeholder(__('Select contact date')),
                                    ])
                                    ->columnSpanFull(),
                            ])
                            ->columnSpan(3),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
