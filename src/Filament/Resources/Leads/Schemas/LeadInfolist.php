<?php

namespace Backstage\Crm\Filament\Resources\Leads\Schemas;

use BackedEnum;
use Backstage\Crm\Filament\Resources\Leads\LeadResource;
use Backstage\Crm\Filament\Resources\Organizations\OrganizationResource;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;

class LeadInfolist
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
                                TextEntry::make('organization.name')
                                    ->label(fn (): string => __('Organization'))
                                    ->icon(fn (): BackedEnum => OrganizationResource::getNavigationIcon()),

                                TextEntry::make('source')
                                    ->label(fn (): string => __('Source'))
                                    ->icon(fn ($state): BackedEnum => $schema->getModel()::getAvailableSourcesIcons()[$state] ?? Heroicon::OutlinedQuestionMarkCircle)
                                    ->iconColor(fn ($state): array | Color => $schema->getModel()::getAvailableSourcesColors()[$state] ?? Color::Gray)
                                    ->color(fn ($state): array | Color => $schema->getModel()::getAvailableSourcesColors()[$state] ?? Color::Gray),

                                TextEntry::make('first_name')
                                    ->label(fn (): string => __('First Name'))
                                    ->icon(fn (): BackedEnum => Heroicon::OutlinedUserCircle),

                                TextEntry::make('last_name')
                                    ->label(fn (): string => __('Last Name'))
                                    ->icon(fn (): BackedEnum => Heroicon::OutlinedUserCircle),

                                TextEntry::make('email')
                                    ->label(fn (): string => __('Email'))
                                    ->icon(fn (): BackedEnum => Heroicon::OutlinedEnvelope)
                                    ->copyable(),

                                TextEntry::make('phone')
                                    ->label(fn (): string => __('Phone'))
                                    ->icon(fn (): BackedEnum => Heroicon::OutlinedPhone)
                                    ->copyable(),

                                TextEntry::make('status')
                                    ->label(fn (): string => __('Status'))
                                    ->icon(fn ($state): BackedEnum => $schema->getModel()::getAvailableStatusesIcons()[$state] ?? Heroicon::OutlinedQuestionMarkCircle)
                                    ->iconColor(fn ($state): array | Color => $schema->getModel()::getAvailableStatusesColors()[$state] ?? Color::Gray)
                                    ->color(fn ($state): array | Color => $schema->getModel()::getAvailableStatusesColors()[$state] ?? Color::Gray),
                            ]),
                    ])
                    ->columnSpanFull(),

                Section::make(fn (): string => __('Additional Information'))
                    ->icon(fn (): BackedEnum => Heroicon::OutlinedInformationCircle)
                    ->description(fn (): string => __('Provide any additional information about the lead.'))
                    ->collapsible(fn (): bool => true)
                    ->schema([
                        TextEntry::make('notes')
                            ->label(fn (): string => __('Notes'))
                            ->html(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
