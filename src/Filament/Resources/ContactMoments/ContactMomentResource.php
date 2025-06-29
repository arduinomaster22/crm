<?php

namespace Backstage\Crm\Filament\Resources\ContactMoments;

use BackedEnum;
use Backstage\Crm\Filament\Resources\ContactMoments\Pages\CreateContactMoment;
use Backstage\Crm\Filament\Resources\ContactMoments\Pages\EditContactMoment;
use Backstage\Crm\Filament\Resources\ContactMoments\Pages\ListContactMoments;
use Backstage\Crm\Filament\Resources\ContactMoments\Pages\ViewContactMoment;
use Backstage\Crm\Filament\Resources\ContactMoments\Schemas\ContactMomentForm;
use Backstage\Crm\Filament\Resources\ContactMoments\Schemas\ContactMomentInfolist;
use Backstage\Crm\Filament\Resources\ContactMoments\Tables\ContactMomentsTable;
use Backstage\Crm\Models\ContactMoment;
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

class ContactMomentResource extends Resource
{
    protected static ?string $model = ContactMoment::class;

    public static function getSlug(?Panel $panel = null): string
    {
        return 'crm/contact-moments';
    }

    public static function getNavigationGroup(): string | UnitEnum | null
    {
        return __('CRM - Social');
    }

    public static function getNavigationIcon(): string | BackedEnum | Htmlable | null
    {
        return Heroicon::OutlinedUserPlus;
    }

    public static function getActiveNavigationIcon(): string | BackedEnum | Htmlable | null
    {
        return Heroicon::UserPlus;
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
        return __('Contact moments');
    }

    public static function getModelLabel(): string
    {
        return __('Contact moment');
    }

    public static function form(Schema $schema): Schema
    {
        return ContactMomentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ContactMomentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactMomentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContactMoments::route('/'),
            'create' => CreateContactMoment::route('/create'),
            'view' => ViewContactMoment::route('/{record}'),
            'edit' => EditContactMoment::route('/{record}/edit'),
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
