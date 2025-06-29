<?php

namespace Backstage\Crm\Filament\Resources\Organizations\Schemas;

use Backstage\Crm\Filament\Resources\Organizations\OrganizationResource;
use Backstage\Crm\Models\Organization;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Http;

class OrganizationForm
{
    public static function configure(Schema $form): Schema
    {
        return $form
            ->schema([
                Section::make()
                    ->heading(__('Organization information'))
                    ->icon(OrganizationResource::getNavigationIcon())
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->columnSpanFull()
                            ->label(fn (): string => __('Name'))
                            ->prefixIcon('heroicon-m-building-office-2'),

                        Forms\Components\Select::make('relation')
                            ->searchable()
                            ->label(fn (): string => __('Relation'))
                            ->prefixIcon('heroicon-m-hashtag')
                            ->preload()
                            ->options(OrganizationResource::getModel()::getOrganizationRelations()),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->label(fn (): string => __('Email'))
                            ->prefixIcon('heroicon-m-at-symbol'),

                        Forms\Components\Select::make('type')
                            ->searchable()
                            ->label(fn (): string => __('Type'))
                            ->prefixIcon('heroicon-m-hashtag')
                            ->preload()
                            ->options(OrganizationResource::getModel()::getOrganizationTypes()),

                        Forms\Components\Select::make('branch')
                            ->searchable()
                            ->label(fn (): string => __('Branch'))
                            ->prefixIcon('heroicon-m-hashtag')
                            ->preload()
                            ->options(OrganizationResource::getModel()::getOrganizationIndustries()),

                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->label(fn (): string => __('Phone'))
                            ->prefixIcon('heroicon-m-phone'),

                        Forms\Components\Select::make('total_employees')
                            ->label(fn (): string => __('Total employees'))
                            ->preload()
                            ->prefixIcon('heroicon-m-user-group')
                            ->options(OrganizationResource::getModel()::getTotalEmployeesOptions()),

                        Forms\Components\TextInput::make('website')
                            ->live()
                            ->label(fn (): string => __('Website'))
                            ->prefixIcon('heroicon-m-globe-alt')
                            ->url()
                            ->prefixIconColor(function (Get $get, $record) {
                                return match ($get('website_check')) {
                                    true => Color::Green,
                                    false => Color::Red,
                                    default => $record ? Color::Green : Color::Gray
                                };
                            })
                            ->suffixAction(fn () => Action::make('action')
                                ->icon('heroicon-m-arrow-down-on-square')
                                ->color('primary')
                                ->visible(fn (Get $get) => ! $get('organization_id') ? false : true)
                                ->action(function (Get $get, Set $set) {
                                    $oganization = Organization::find($get('organization_id'));

                                    $set('website_check', true);
                                    $set('site', $oganization->website ?? $get('website'));
                                }))
                            ->helperText(function (Get $get, $record) {
                                return match ($get('website_check')) {
                                    true => __('Website exists'),
                                    false => __('Website is offline, website returns a redirect or page is not found'),
                                    default => $record ? null : __('Check website')
                                };
                            })
                            ->afterStateUpdated(function ($state, Set $set) {
                                try {
                                    $set('website_check', $state ? Http::get($state)->successful() : false);
                                } catch (\Exception $e) {
                                    $set('website_check', false);
                                }
                            })
                            ->afterStateHydrated(function ($state, Set $set) {
                                try {
                                    $set('website_check', $state ? Http::get($state)->successful() : false);
                                } catch (\Exception $e) {
                                    $set('website_check', false);
                                }
                            }),

                        Forms\Components\Hidden::make('website_check'),
                    ])
                    ->columnSpanFull(),

                Section::make(fn (): string => __('Address information'))
                    ->columns(2)
                    ->collapsible(fn (): bool => true)
                    ->schema([
                        Forms\Components\TextInput::make('address_zipcode')
                            ->live()
                            ->reactive()
                            ->required()
                            ->label(fn (): string => __('Zipcode'))
                            ->prefixIcon('heroicon-m-map-pin'),

                        Forms\Components\TextInput::make('address_house_number')
                            ->live()
                            ->required()
                            ->label(fn (): string => __('House number'))
                            ->prefixIcon('heroicon-m-map-pin'),

                        Forms\Components\TextInput::make('address_street')
                            ->required()
                            ->label(fn (): string => __('Street'))
                            ->prefixIcon('heroicon-m-map-pin'),

                        Forms\Components\TextInput::make('address_city')
                            ->required()
                            ->label(fn (): string => __('City'))
                            ->prefixIcon('heroicon-m-map-pin'),

                        Forms\Components\TextInput::make('address_country')
                            ->required()
                            ->label(fn (): string => __('Country'))
                            ->prefixIcon('heroicon-m-map-pin'),
                    ]),

                Section::make(fn (): string => __('Address information (mailing)'))
                    ->columns(2)
                    ->collapsible(fn (): bool => true)
                    ->schema([
                        Forms\Components\TextInput::make('mailing_address_zipcode')
                            ->live()
                            ->required()
                            ->label(fn (): string => __('Zipcode'))
                            ->prefixIcon('heroicon-m-map-pin'),

                        Forms\Components\TextInput::make('mailing_address_house_number')
                            ->live()
                            ->required()
                            ->label(fn (): string => __('House number'))
                            ->prefixIcon('heroicon-m-map-pin'),

                        Forms\Components\TextInput::make('mailing_address_street')
                            ->required()
                            ->label(fn (): string => __('Street'))

                            ->prefixIcon('heroicon-m-map-pin'),

                        Forms\Components\TextInput::make('mailing_address_city')
                            ->required()
                            ->label(fn (): string => __('City'))

                            ->prefixIcon('heroicon-m-map-pin'),

                        Forms\Components\TextInput::make('mailing_address_country')
                            ->required()
                            ->label(fn (): string => __('Country'))
                            ->prefixIcon('heroicon-m-map-pin'),
                    ]),
            ]);
    }
}
