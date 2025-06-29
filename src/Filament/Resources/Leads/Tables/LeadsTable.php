<?php

namespace Backstage\Crm\Filament\Resources\Leads\Tables;

use BackedEnum;
use Filament\Tables\Table;
use Backstage\Crm\Models\Lead;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\ForceDeleteBulkAction;

class LeadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('status')
                    ->label(fn(): string => __('Status'))
                    ->color(fn($state): array => $table->getModel()::getAvailableStatusesColors()[$state] ?? Color::Gray)
                    ->icon(fn($record): BackedEnum => $record::getAvailableStatusesIcons()[$record->status] ?? Heroicon::OutlinedQuestionMarkCircle)
                    ->formatStateUsing(fn($state): string => $table->getModel()::getAvailableStatuses()[$state] ?? __('Unknown'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label(fn(): string => __('Email'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('source')
                    ->label(fn(): string => __('Source'))
                    ->color(fn($state): array => $table->getModel()::getAvailableSourcesColors()[$state] ?? Color::Gray)
                    ->icon(fn($record): BackedEnum => $record::getAvailableSourcesIcons()[$record->source] ?? Heroicon::OutlinedQuestionMarkCircle)
                    ->formatStateUsing(fn($state): string => $table->getModel()::getAvailableSources()[$state] ?? __('Unknown'))
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
