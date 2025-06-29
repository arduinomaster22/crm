<?php

namespace Backstage\Crm\Filament\Resources\Shared\RelationManagers;

use BackedEnum;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class TagsRelationManager extends RelationManager
{
    protected static string $relationship = 'tags';

    public static function getIcon(Model $ownerRecord, string $pageClass): ?string
    {
        return 'heroicon-o-tag';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(fn (): string => __('Name'))
                    ->required()
                    ->maxLength(fn (): int => 255)
                    ->prefixIcon(fn (): BackedEnum => Heroicon::OutlinedTag),

                ColorPicker::make('color')
                    ->label(fn (): string => __('Color'))
                    ->default('#000000')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading(__('Tags'))
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->badge()
                    ->color(fn (Model $record) => Color::hex($record->getAttribute('color'))),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label(fn (): string => __('Create tag')),

                AttachAction::make()
                    ->preloadRecordSelect()
                    ->multiple()
                    ->recordTitleAttribute('name'),
            ])
            ->recordActions([
                EditAction::make(),

                DetachAction::make(),

                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),

                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
