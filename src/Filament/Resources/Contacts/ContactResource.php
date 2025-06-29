<?php

namespace Backstage\Crm\Filament\Resources\Contacts;

use BackedEnum;
use Backstage\Crm\Filament\Resources\Contacts\Pages\CreateContact;
use Backstage\Crm\Filament\Resources\Contacts\Pages\EditContact;
use Backstage\Crm\Filament\Resources\Contacts\Pages\ListContacts;
use Backstage\Crm\Filament\Resources\Contacts\Pages\ViewContact;
use Backstage\Crm\Filament\Resources\Contacts\Schemas\ContactForm;
use Backstage\Crm\Filament\Resources\Contacts\Schemas\ContactInfolist;
use Backstage\Crm\Filament\Resources\Contacts\Tables\ContactsTable;
use Backstage\Crm\Filament\Resources\Shared\RelationManagers\TagsRelationManager;
use Backstage\Crm\Models\Contact;
use Filament\Panel;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    public static function getSlug(?Panel $panel = null): string
    {
        return 'crm/contacts';
    }

    public static function getNavigationGroup(): string | UnitEnum | null
    {
        return __('CRM - Relations');
    }

    public static function getNavigationIcon(): string | BackedEnum | Htmlable | null
    {
        return Heroicon::OutlinedUserCircle;
    }

    public static function getActiveNavigationIcon(): string | BackedEnum | Htmlable | null
    {
        return Heroicon::UserCircle;
    }

    public static function getNavigationBadge(): ?string
    {
        return parent::getEloquentQuery()
            ->count();
    }

    public static function getNavigationBadgeColor(): string | array | null
    {
        return (array) Color::Pink;
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return __('Active :plural', ['plural' => str(static::getPluralModelLabel())->lower()->toString()]);
    }

    public static function getPluralModelLabel(): string
    {
        return __('Contacts');
    }

    public static function getModelLabel(): string
    {
        return __('Contact');
    }

    public static function form(Schema $schema): Schema
    {
        return ContactForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ContactInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            TagsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContacts::route('/'),
            'create' => CreateContact::route('/create'),
            'view' => ViewContact::route('/{record}'),
            'edit' => EditContact::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
