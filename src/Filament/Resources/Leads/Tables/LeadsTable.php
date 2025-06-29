<?php

namespace Backstage\Crm\Filament\Resources\Leads\Tables;

use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class LeadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('status')
                    ->label(fn (): string => __('Status'))
                    ->tooltip(fn ($state): string => $table->getModel()::getAvailableStatuses()[$state])
                    ->color(fn ($state): array => $table->getModel()::getAvailableStatusesColors()[$state] ?? Color::Gray)
                    ->icon(fn ($record): BackedEnum => $record::getAvailableStatusesIcons()[$record->status] ?? Heroicon::OutlinedQuestionMarkCircle)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label(fn (): string => __('Email'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('source')
                    ->label(fn (): string => __('Source'))
                    ->tooltip(fn ($state): string => $table->getModel()::getAvailableSources()[$state])
                    ->color(fn ($state): array => $table->getModel()::getAvailableSourcesColors()[$state] ?? Color::Gray)
                    ->icon(fn ($record): BackedEnum => $record::getAvailableSourcesIcons()[$record->source] ?? Heroicon::OutlinedQuestionMarkCircle)
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),

                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),

                    ForceDeleteBulkAction::make(),

                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
