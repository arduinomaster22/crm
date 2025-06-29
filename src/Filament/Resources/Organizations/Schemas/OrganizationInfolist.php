<?php

namespace Backstage\Crm\Filament\Resources\Organizations\Schemas;

use Backstage\Crm\Filament\Resources\Organizations\OrganizationResource;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrganizationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->heading(__('Organization information'))
                    ->icon(OrganizationResource::getNavigationIcon())
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')
                            ->columnSpanFull()
                            ->label(fn (): string => __('Name'))
                            ->icon('heroicon-m-building-office-2'),

                        TextEntry::make('relation')
                            ->label(fn (): string => __('Relation'))
                            ->icon('heroicon-m-hashtag')
                            ->formatStateUsing(fn ($state) => OrganizationResource::getModel()::getOrganizationRelations()[$state] ?? __('Unknown')),

                        TextEntry::make('email')
                            ->label(fn (): string => __('Email'))
                            ->icon('heroicon-m-at-symbol'),

                        TextEntry::make('type')
                            ->label(fn (): string => __('Type'))
                            ->icon('heroicon-m-hashtag')
                            ->formatStateUsing(fn ($state) => OrganizationResource::getModel()::getOrganizationTypes()[$state] ?? __('Unknown')),

                        TextEntry::make('branch')
                            ->label(fn (): string => __('Branch'))
                            ->icon('heroicon-m-hashtag')
                            ->formatStateUsing(fn ($state) => OrganizationResource::getModel()::getOrganizationIndustries()[$state] ?? __('Unknown')),

                        TextEntry::make('phone')

                            ->label(fn (): string => __('Phone'))
                            ->icon('heroicon-m-phone'),

                        TextEntry::make('total_employees')
                            ->label(fn (): string => __('Total employees'))
                            ->icon('heroicon-m-user-group'),

                        TextEntry::make('website')
                            ->label(fn (): string => __('Website'))
                            ->icon('heroicon-m-globe-alt'),
                    ])
                    ->columnSpanFull(),

                Section::make(fn (): string => __('Address information'))
                    ->columns(2)
                    ->collapsible(fn (): bool => true)
                    ->schema([
                        TextEntry::make('address_zipcode')
                            ->label(fn (): string => __('Zipcode'))
                            ->icon('heroicon-m-map-pin'),

                        TextEntry::make('address_house_number')
                            ->label(fn (): string => __('House number'))
                            ->icon('heroicon-m-map-pin'),

                        TextEntry::make('address_street')
                            ->label(fn (): string => __('Street'))
                            ->icon('heroicon-m-map-pin'),

                        TextEntry::make('address_city')
                            ->label(fn (): string => __('City'))
                            ->icon('heroicon-m-map-pin'),

                        TextEntry::make('address_country')
                            ->label(fn (): string => __('Country'))
                            ->icon('heroicon-m-map-pin'),
                    ]),

                Section::make(fn (): string => __('Address information (mailing)'))
                    ->columns(2)
                    ->collapsible(fn (): bool => true)
                    ->schema([
                        TextEntry::make('mailing_address_zipcode')
                            ->label(fn (): string => __('Zipcode'))
                            ->icon('heroicon-m-map-pin'),

                        TextEntry::make('mailing_address_house_number')
                            ->label(fn (): string => __('House number'))
                            ->icon('heroicon-m-map-pin'),

                        TextEntry::make('mailing_address_street')
                            ->label(fn (): string => __('Street'))
                            ->icon('heroicon-m-map-pin'),

                        TextEntry::make('mailing_address_city')
                            ->label(fn (): string => __('City'))
                            ->icon('heroicon-m-map-pin'),

                        TextEntry::make('mailing_address_country')

                            ->label(fn (): string => __('Country'))
                            ->icon('heroicon-m-map-pin'),
                    ]),

            ]);
    }
}
