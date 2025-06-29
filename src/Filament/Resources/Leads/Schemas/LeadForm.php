<?php

namespace Backstage\Crm\Filament\Resources\Leads\Schemas;

use BackedEnum;
use Backstage\Crm\Filament\Resources\Leads\LeadResource;
use Backstage\Crm\Filament\Resources\Organizations\OrganizationResource;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;

class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(fn (): string => __('Lead Details'))
                    ->icon(fn (): BackedEnum => LeadResource::getNavigationIcon())
                    ->description(fn (): string => __('Fill in the details of the lead.'))
                    ->collapsible(fn (): bool => true)
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('organization_id')
                                    ->label(fn (): string => __('Organization'))
                                    ->relationship('organization', 'name')
                                    ->searchable()
                                    ->prefixIcon(fn (): BackedEnum => OrganizationResource::getNavigationIcon())
                                    ->required()
                                    ->preload()
                                    ->placeholder(fn (): string => __('Select an organization')),

                                Select::make('source')
                                    ->label(fn (): string => __('Source'))
                                    ->options(fn (): array => $schema->getModel()::getAvailableSources())
                                    ->live()
                                    ->prefixIcon(fn ($state): BackedEnum => $schema->getModel()::getAvailableSourcesIcons()[$state] ?? Heroicon::OutlinedQuestionMarkCircle)
                                    ->prefixIconColor(fn ($state): array => $schema->getModel()::getAvailableSourcesColors()[$state] ?? Color::Gray)
                                    ->required()
                                    ->native(fn (): bool => false)
                                    ->searchable()
                                    ->placeholder(fn (): string => __('Select source')),

                                TextInput::make('first_name')
                                    ->label(fn (): string => __('First Name'))
                                    ->required()
                                    ->maxLength(fn (): int => 255)
                                    ->prefixIcon(fn (): BackedEnum => Heroicon::OutlinedUserCircle)
                                    ->live()
                                    ->afterStateUpdated(fn ($set, $get) => static::setEmailFromName($set, $get))
                                    ->placeholder(fn (): string => __('Enter first name')),

                                TextInput::make('last_name')
                                    ->label(fn (): string => __('Last Name'))
                                    ->required()
                                    ->maxLength(fn (): int => 255)
                                    ->prefixIcon(fn (): BackedEnum => Heroicon::OutlinedUserCircle)
                                    ->live(debounce: 500)
                                    ->afterStateUpdated(fn ($set, $get) => static::setEmailFromName($set, $get))
                                    ->placeholder(fn (): string => __('Enter last name')),

                                TextInput::make('email')
                                    ->label(fn (): string => __('Email'))
                                    ->email()
                                    ->required()
                                    ->maxLength(fn (): int => 255)
                                    ->prefixIcon(fn (): BackedEnum => Heroicon::OutlinedEnvelope)
                                    ->placeholder(fn (): string => __('Enter email address')),

                                TextInput::make('phone')
                                    ->label(fn (): string => __('Phone'))
                                    ->tel()
                                    ->maxLength(fn (): int => 20)
                                    ->prefixIcon(fn (): BackedEnum => Heroicon::OutlinedPhone)
                                    ->placeholder(fn (): string => __('Enter phone number')),

                                Select::make('status')
                                    ->label(fn (): string => __('Status'))
                                    ->options(fn (): array => $schema->getModel()::getAvailableStatuses())
                                    ->live()
                                    ->prefixIcon(fn ($state): BackedEnum => $schema->getModel()::getAvailableStatusesIcons()[$state] ?? Heroicon::OutlinedQuestionMarkCircle)
                                    ->prefixIconColor(fn ($state): array => $schema->getModel()::getAvailableStatusesColors()[$state] ?? Color::Gray)
                                    ->required()
                                    ->native(fn (): bool => false)
                                    ->searchable()
                                    ->placeholder(fn (): string => __('Select status')),
                            ]),
                    ])
                    ->columnSpanFull(),

                Section::make(fn (): string => __('Additional Information'))
                    ->icon(fn (): BackedEnum => Heroicon::OutlinedInformationCircle)
                    ->description(fn (): string => __('Provide any additional information about the lead.'))
                    ->collapsible(fn (): bool => true)
                    ->schema([
                        RichEditor::make('notes')
                            ->label(fn (): string => __('Notes'))
                            ->maxLength(fn (): int => 1000)
                            ->placeholder(fn (): string => __('Enter any additional notes')),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function setEmailFromName(Set $set, Get $get): void
    {
        $firstName = $get('first_name');
        $lastName = $get('last_name');

        if ($firstName && $lastName) {
            $email = $firstName . $lastName . '@example.com';
            $set('email', strtolower($email));
        }
    }
}
