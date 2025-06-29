<?php

namespace Backstage\Crm\Filament\Resources\ContactMoments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;

class ContactMomentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultGroup('contact_date')
            ->columns([
                TextColumn::make('subject')
                    ->label(__('Subject'))
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
            ->groupingSettingsHidden(true)
            ->defaultSort('contact_date', 'asc')
            ->groups([
                Group::make('contact_date')
                    ->label(__('Contact Date'))
                    ->date(),
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
