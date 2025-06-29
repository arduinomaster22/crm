<?php

namespace Backstage\Crm\Filament\Resources\Organizations\RelationManagers;

use Backstage\Crm\Filament\Resources\Contacts\ContactResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class ContactsRelationManager extends RelationManager
{
    protected static string $relationship = 'contacts';

    /**
     * @return ContactResource
     */
    public static function getRelatedResource(): ?string
    {
        return ContactResource::class;
    }

    public function infolist(Schema $schema): Schema
    {
        return static::getRelatedResource()::infolist($schema);
    }

    public function form(Schema $schema): Schema
    {
        return static::getRelatedResource()::form($schema);
    }

    public function table(Table $table): Table
    {
        return static::getRelatedResource()::table($table)
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
