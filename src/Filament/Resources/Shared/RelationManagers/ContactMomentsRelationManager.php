<?php

namespace Backstage\Crm\Filament\Resources\Shared\RelationManagers;

use Backstage\Crm\Filament\Resources\ContactMoments\ContactMomentResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ContactMomentsRelationManager extends RelationManager
{
    protected static string $relationship = 'contactMoments';

    public static function getRelatedResource(): ?string
    {
        return ContactMomentResource::class;
    }

    public static function getIcon(Model $ownerRecord, string $pageClass): ?string
    {
        return 'heroicon-o-user-plus';
    }

    public function form(Schema $schema): Schema
    {
        return static::getRelatedResource()::form($schema);
    }

    public function table(Table $table): Table
    {
        return static::getRelatedResource()::table($table)
            ->heading(__('Contact Moments'))
            ->headerActions([
                CreateAction::make()
                    ->label(fn (): string => __('Create tag')),
            ])
            ->recordActions([
                EditAction::make(),

                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
