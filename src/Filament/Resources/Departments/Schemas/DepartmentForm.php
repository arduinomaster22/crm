<?php

namespace Backstage\Crm\Filament\Resources\Departments\Schemas;

use Backstage\Crm\Filament\Resources\Organizations\OrganizationResource;
use Backstage\Crm\Models\Organization;
use Filament\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Http;

class DepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Select::make('organization_id')
                            ->live()
                            ->required()
                            ->searchable()
                            ->preload()
                            ->label(fn (): string => __('Organization'))
                            ->relationship(name: 'organization', titleAttribute: 'name')
                            ->prefixIcon('heroicon-m-building-office-2')
                            ->createOptionForm(fn ($form) => OrganizationResource::form($form))
                            ->hintAction(
                                Action::make('view_organization')
                                    ->label(fn (): string => __('View organization'))
                                    ->icon('heroicon-m-eye')
                                    ->color('primary')
                                    ->visible(fn (Get $get) => ! is_null($get('organization_id')))
                                    ->url(fn ($record) => OrganizationResource::getUrl('view', ['record' => $record->organization]))
                            ),

                        TextInput::make('name')
                            ->live()
                            ->reactive()
                            ->required()
                            ->label(fn (): string => __('Name'))
                            ->prefixIcon('heroicon-m-stop')
                            ->hintAction(
                                Action::make('copy_organization_name')
                                    ->label(fn (): string => __('Copy organization name'))
                                    ->color('primary')
                                    ->icon('heroicon-m-arrow-down-on-square')
                                    ->visible(fn (Get $get, $operation) => ! $get('organization_id') ? false : ($operation !== 'view'))
                                    ->action(fn (Get $get, Set $set) => $set('name', Organization::find($get('organization_id'))->name ?? null))
                            ),

                        TextInput::make('email')
                            ->live()
                            ->email()
                            ->reactive()
                            ->required()
                            ->label(fn (): string => __('Email'))
                            ->prefixIcon('heroicon-m-at-symbol')
                            ->hintAction(
                                Action::make('copy_organization_email')
                                    ->label(fn (): string => __('Copy organization email'))
                                    ->color('primary')
                                    ->icon('heroicon-m-arrow-down-on-square')
                                    ->visible(fn (Get $get, $operation) => ! $get('organization_id') ? false : ($operation !== 'view'))
                                    ->action(fn (Get $get, Set $set) => $set('email', Organization::find($get('organization_id'))->email ?? null))
                            ),

                        TextInput::make('phone_number')
                            ->tel()
                            ->label(fn (): string => __('Phone number'))
                            ->prefixIcon('heroicon-m-phone')
                            ->hintAction(
                                Action::make('copy_organization_phone')
                                    ->label(fn (): string => __('Copy organization phone'))
                                    ->visible(fn (Get $get, $operation) => ! $get('organization_id') ? false : ($operation !== 'view'))
                                    ->action(fn (Get $get, Set $set) => $set('phone_number', Organization::find($get('organization_id'))->phone ?? null))
                                    ->icon('heroicon-m-arrow-down-on-square')
                                    ->color('primary')
                            ),

                        TextInput::make('address')
                            ->label(fn (): string => __('Address'))
                            ->prefixIcon('heroicon-m-map')
                            ->hintAction(
                                Action::make('copy_organization_address')
                                    ->label(fn (): string => __('Copy organization address'))
                                    ->visible(fn (Get $get, $operation) => ! $get('organization_id') ? false : ($operation !== 'view'))
                                    ->action(fn (Get $get, Set $set) => $set('address', Organization::find($get('organization_id'))->fullAddress ?? null))
                                    ->icon('heroicon-m-arrow-down-on-square')
                                    ->color('primary')
                            ),

                        TextInput::make('mailing_address')
                            ->label(fn (): string => __('Mailing address'))
                            ->prefixIcon('heroicon-m-envelope')
                            ->hintAction(
                                Action::make('copy_organization_mailing_address')
                                    ->label(fn (): string => __('Copy organization mailing address'))
                                    ->visible(fn (Get $get, $operation) => ! $get('organization_id') ? false : ($operation !== 'view'))
                                    ->action(fn (Get $get, Set $set) => $set('mailing_address', Organization::find($get('organization_id'))->fullmailingAddress ?? null))
                                    ->icon('heroicon-m-arrow-down-on-square')
                                    ->color('primary')
                            ),

                        TextInput::make('site')
                            ->live()
                            ->label(fn (): string => __('Website'))
                            ->prefixIcon('heroicon-m-globe-alt')
                            ->prefixIconColor(function (Get $get, $record) {
                                return match ($get('website_check')) {
                                    true => Color::Green,
                                    false => Color::Red,
                                    default => $record ? Color::Green : Color::Gray
                                };
                            })
                            ->visible(fn (Get $get, $operation) => ! $get('organization_id') ? false : ($operation !== 'view'))
                            ->hintAction(
                                Action::make('copy_organization_website')
                                    ->label(fn (): string => __('Copy organization website'))
                                    ->color('primary')
                                    ->icon('heroicon-m-arrow-down-on-square')
                                    ->action(function (Get $get, Set $set) {
                                        $oganization = Organization::find($get('organization_id'));

                                        $set('website_check', true);
                                        $set('site', $oganization->website ?? null);
                                    })
                            )
                            ->helperText(function (Get $get, $record) {
                                return match ($get('website_check')) {
                                    true => __('Website exists!'),
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

                        Hidden::make('website_check'),

                        Select::make('total_employees')
                            ->label(fn (): string => __('Total employees'))
                            ->options(fn () => OrganizationResource::getModel()::getTotalEmployeesOptions()->toArray())
                            ->preload()
                            ->prefixIcon('heroicon-m-user-group')
                            ->hintAction(Action::make('copy_organization_total_employees')
                                ->label(fn (): string => __('Copy organization total employees'))
                                ->visible(fn (Get $get, $operation) => ! $get('organization_id') ? false : ($operation !== 'view'))
                                ->icon('heroicon-m-arrow-down-on-square')
                                ->color('primary')
                                ->action(fn (Get $get, Set $set) => $set('total_employees', Organization::where('id', $get('organization_id'))->first()->total_employees ?? null))),

                        Select::make('branch')
                            ->searchable()
                            ->label(fn (): string => __('Branch'))
                            ->prefixIcon('heroicon-m-hashtag')
                            ->hintAction(Action::make('action')
                                ->visible(fn (Get $get, $operation) => ! $get('organization_id') ? false : ($operation !== 'view'))
                                ->icon('heroicon-m-arrow-down-on-square')
                                ->color('primary')
                                ->label(fn (): string => __('Copy organization branch'))
                                ->action(fn (Get $get, Set $set) => $set('branch', Organization::find($get('organization_id'))->branch ?? null)))
                            ->options(fn () => OrganizationResource::getModel()::getOrganizationIndustries()),
                    ])
                    ->columns()
                    ->columnSpanFull(),
            ]);
    }
}
