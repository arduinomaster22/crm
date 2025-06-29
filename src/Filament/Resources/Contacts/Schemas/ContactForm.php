<?php

namespace Backstage\Crm\Filament\Resources\Contacts\Schemas;

use BackedEnum;
use Backstage\Crm\Filament\Resources\Contacts\ContactResource;
use Backstage\Crm\Filament\Resources\Leads\Schemas\LeadForm;
use Backstage\Crm\Filament\Resources\Organizations\OrganizationResource;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(9)
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                Section::make(__('Contact'))
                                    ->icon(fn (): BackedEnum => ContactResource::getNavigationIcon())
                                    ->schema([
                                        TextInput::make('first_name')
                                            ->label(fn (): string => __('First Name'))
                                            ->live()
                                            ->afterStateUpdated(fn ($set, $get) => LeadForm::setEmailFromName($set, $get))
                                            ->prefixIcon(fn (): BackedEnum => Heroicon::OutlinedUserCircle),

                                        TextInput::make('last_name')
                                            ->label(fn (): string => __('Last Name'))
                                            ->live()
                                            ->afterStateUpdated(fn ($set, $get) => LeadForm::setEmailFromName($set, $get))
                                            ->prefixIcon(fn (): BackedEnum => Heroicon::OutlinedUserCircle),

                                        TextInput::make('address_street')
                                            ->label(fn (): string => __('Street'))
                                            ->prefixIcon(fn (): BackedEnum => Heroicon::OutlinedHome)
                                            ->required(),

                                        TextInput::make('address_zipcode')
                                            ->label(fn (): string => __('Zip Code'))
                                            ->prefixIcon(fn (): BackedEnum => Heroicon::OutlinedMapPin)
                                            ->required(),

                                        TextInput::make('address_city')
                                            ->label(fn (): string => __('City'))
                                            ->prefixIcon(fn (): BackedEnum => Heroicon::OutlinedMapPin)
                                            ->required(),

                                        TextInput::make('address_country')
                                            ->label(fn (): string => __('Country'))
                                            ->prefixIcon(fn (): BackedEnum => Heroicon::OutlinedGlobeAlt)
                                            ->required(),
                                    ])
                                    ->columns(2)
                                    ->columnSpanFull(),

                                Section::make(__('Notes'))
                                    ->icon(fn (): BackedEnum => Heroicon::OutlinedDocumentText)
                                    ->schema([
                                        RichEditor::make('notes')
                                            ->hiddenLabel()
                                            ->helperText(fn (): string => __('Additional notes about the contact.'))
                                            ->columnSpanFull(),
                                    ]),

                            ])
                            ->columnSpan(6),
                        Grid::make(1)
                            ->schema([
                                Section::make(__('Details'))
                                    ->icon(fn (): BackedEnum => Heroicon::OutlinedInformationCircle)
                                    ->schema([
                                        Select::make('organization_id')
                                            ->live()
                                            ->preload()
                                            ->required()
                                            ->searchable()
                                            ->label(fn (): string => __('Organization'))
                                            ->relationship(name: 'organization', titleAttribute: 'name')
                                            ->prefixIcon('heroicon-m-building-office-2')
                                            ->createOptionForm(fn ($form) => OrganizationResource::form($form)),

                                        TextInput::make('job_title')
                                            ->label(fn (): string => __('Job Title'))
                                            ->prefixIcon(fn (): BackedEnum => Heroicon::OutlinedBriefcase)
                                            ->required(),
                                    ])
                                    ->columnSpanFull(),

                                Section::make(__('Contact Information'))
                                    ->icon(fn (): BackedEnum => Heroicon::OutlinedPhone)
                                    ->schema([
                                        TextInput::make('email')
                                            ->label(fn (): string => __('Email'))
                                            ->prefixIcon(fn (): BackedEnum => Heroicon::OutlinedEnvelope)
                                            ->email()
                                            ->live()
                                            ->required(),

                                        TextInput::make('phone')
                                            ->label(fn (): string => __('Phone'))
                                            ->prefixIcon(fn (): BackedEnum => Heroicon::OutlinedPhone)
                                            ->tel()
                                            ->required(),
                                    ]),
                            ])
                            ->columnSpan(3),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
