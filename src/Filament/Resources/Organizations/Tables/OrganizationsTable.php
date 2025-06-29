<?php

namespace Backstage\Crm\Filament\Resources\Organizations\Tables;

use Awcodes\BadgeableColumn\Components\Badge;
use Awcodes\BadgeableColumn\Components\BadgeableColumn;
use Backstage\Crm\Models\Tag;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class OrganizationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                BadgeableColumn::make('name')
                    ->searchable()
                    ->label(fn (): string => __('Name'))
                    ->suffixBadges(function ($record) {
                        $record->load('tags');

                        return $record->tags->map(function (Tag $tag) {
                            return Badge::make($tag->name)
                                ->label($tag->name)
                                ->color(Color::hex($tag->color));
                        })->values();
                    }),

                TextColumn::make('departments_count')
                    ->counts('departments')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color('info')
                    ->label(fn (): string => __('Departments')),
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
