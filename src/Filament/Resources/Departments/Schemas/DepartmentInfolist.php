<?php

namespace Backstage\Crm\Filament\Resources\Departments\Schemas;

use BackedEnum;
use Backstage\Crm\Filament\Resources\Departments\DepartmentResource;
use Backstage\Crm\Filament\Resources\Organizations\OrganizationResource;
use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class DepartmentInfolist
{
    public static function configure(Schema $infolist): Schema
    {
        return $infolist
            ->components([
                Section::make(__('Department'))
                    ->icon(fn (): BackedEnum => DepartmentResource::getNavigationIcon())
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

                        TextEntry::make('name')
                            ->label(fn (): string => __('Name'))
                            ->icon(fn (): BackedEnum => Heroicon::Stop),

                        TextEntry::make('email')
                            ->label(fn (): string => __('Email'))
                            ->icon(fn (): BackedEnum => Heroicon::AtSymbol),

                        TextEntry::make('phone_number')
                            ->copyable()
                            ->label(fn (): string => __('Phone number'))
                            ->icon(fn (): BackedEnum => Heroicon::Phone),

                        TextEntry::make('address')
                            ->label(fn (): string => __('Address'))
                            ->copyable()
                            ->icon(fn (): BackedEnum => Heroicon::Map),

                        TextEntry::make('mailing_address')
                            ->label(fn (): string => __('Mailing address'))
                            ->icon(fn (): BackedEnum => Heroicon::Envelope),

                        TextEntry::make('site')
                            ->label(fn (): string => __('Website'))
                            ->icon(fn (): BackedEnum => Heroicon::OutlinedGlobeAlt)
                            ->copyable()
                            ->iconColor(function ($state) {
                                try {
                                    $response = Http::get($state);

                                    return $response->successful() ? Color::Green : Color::Red;
                                } catch (\Exception $e) {
                                    return Color::Red;
                                }
                            }),

                        TextEntry::make('total_employees')
                            ->label(fn (): string => __('Total employees'))
                            ->formatStateUsing(fn ($state) => OrganizationResource::getModel()::getTotalEmployeesOptions()->toArray()[$state])
                            ->icon(fn (): BackedEnum => Heroicon::UserGroup),

                        TextEntry::make('branch')
                            ->label(fn (): string => __('Branch'))
                            ->icon(fn (): BackedEnum => Heroicon::Hashtag)
                            ->formatStateUsing(fn ($state) => OrganizationResource::getModel()::getOrganizationIndustries()->toArray()[$state] ?? __('Unknown')),
                    ])
                    ->columns()
                    ->columnSpanFull(),

            ]);
    }
}
