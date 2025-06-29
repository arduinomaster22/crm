<?php

namespace Backstage\Crm\Filament\Resources\Contacts\Schemas;

use BackedEnum;
use Backstage\Crm\Filament\Resources\Contacts\ContactResource;
use Backstage\Crm\Filament\Resources\Organizations\OrganizationResource;
use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;

class ContactInfolist
{
    public static function configure(Schema $infolist): Schema
    {
        return $infolist
            ->components([
                Grid::make(9)
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                Section::make(__('Contact'))
                                    ->icon(fn (): BackedEnum => ContactResource::getNavigationIcon())
                                    ->schema([
                                        TextEntry::make('first_name')
                                            ->label(fn (): string => __('First Name'))
                                            ->icon(fn (): BackedEnum => Heroicon::OutlinedUserCircle),

                                        TextEntry::make('last_name')
                                            ->label(fn (): string => __('Last Name'))
                                            ->icon(fn (): BackedEnum => Heroicon::OutlinedUserCircle),

                                        TextEntry::make('address_street')
                                            ->label(fn (): string => __('Street'))
                                            ->icon(fn (): BackedEnum => Heroicon::OutlinedHome),

                                        TextEntry::make('address_zipcode')
                                            ->label(fn (): string => __('Zip Code'))
                                            ->icon(fn (): BackedEnum => Heroicon::OutlinedMapPin),

                                        TextEntry::make('address_city')
                                            ->label(fn (): string => __('City'))
                                            ->icon(fn (): BackedEnum => Heroicon::OutlinedMapPin),

                                        TextEntry::make('address_country')
                                            ->label(fn (): string => __('Country'))
                                            ->icon(fn (): BackedEnum => Heroicon::OutlinedGlobeAlt),
                                    ])
                                    ->columns(2)
                                    ->columnSpanFull(),

                                Section::make(__('Notes'))
                                    ->icon(fn (): BackedEnum => Heroicon::OutlinedDocumentText)
                                    ->schema([
                                        TextEntry::make('notes')
                                            ->html()
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
                                        TextEntry::make('organization.name')
                                            ->label(fn (): string => __('Organization'))
                                            ->hintAction(
                                                Action::make('view_organization')
                                                    ->hiddenLabel()
                                                    ->button()
                                                    ->tooltip(fn (): string => __('View organization'))
                                                    ->icon(fn (): BackedEnum => Heroicon::OutlinedBuildingOffice2)
                                                    ->url(fn (Model $record) => OrganizationResource::getUrl('view', ['record' => $record]))
                                            ),

                                        TextEntry::make('job_title')
                                            ->label(fn (): string => __('Job Title'))
                                            ->icon(fn (): BackedEnum => Heroicon::OutlinedBriefcase),
                                    ])
                                    ->columnSpanFull(),

                                Section::make(__('Contact Information'))
                                    ->icon(fn (): BackedEnum => Heroicon::OutlinedPhone)
                                    ->schema([
                                        TextEntry::make('email')
                                            ->label(fn (): string => __('Email'))
                                            ->icon(fn (): BackedEnum => Heroicon::OutlinedEnvelope)
                                            ->copyable(),

                                        TextEntry::make('phone')
                                            ->label(fn (): string => __('Phone'))
                                            ->icon(fn (): BackedEnum => Heroicon::OutlinedPhone)
                                            ->copyable(),
                                    ]),
                            ])
                            ->columnSpan(3),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
