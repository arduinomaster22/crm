<?php

namespace Backstage\Crm\Filament\Pages;

use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Dashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use UnitEnum;

class CrmDashboard extends Dashboard
{
    use HasFiltersForm;

    protected static string $routePath = '/crm';

    protected static ?int $navigationSort = null;

    public static function getNavigationIcon(): string | BackedEnum | Htmlable | null
    {
        return Heroicon::OutlinedBriefcase;
    }

    public static function getActiveNavigationIcon(): string | BackedEnum | Htmlable | null
    {
        return Heroicon::Briefcase;
    }

    public static function getNavigationLabel(): string
    {
        return __('CRM');
    }

    public static function getNavigationGroup(): string | UnitEnum | null
    {
        return __('CRM');
    }

    public function getTitle(): string | Htmlable
    {
        return __('CRM - Dashboard');
    }

    public function getWidgets(): array
    {
        return [];
    }

    protected function getHeaderWidgets(): array
    {
        return [];
    }

    public function filtersForm(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->schema([
                Section::make()
                    ->schema([
                        DatePicker::make('start_date')
                            ->label(__('Start Date'))
                            ->default(now()->startOfMonth())
                            ->prefixIcon(fn (): BackedEnum => Heroicon::OutlinedCalendar)
                            ->inlinePrefix()
                            ->native(false)
                            ->columnSpan(1),

                        DatePicker::make('end_date')
                            ->label(__('End Date'))
                            ->default(now()->endOfMonth())
                            ->prefixIcon(fn (): BackedEnum => Heroicon::OutlinedCalendar)
                            ->inlinePrefix()
                            ->native(false)
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
