<?php

namespace Backstage\Crm\Filament\Resources\Leads;

use BackedEnum;
use Backstage\Crm\Filament\Resources\Leads\Pages\CreateLead;
use Backstage\Crm\Filament\Resources\Leads\Pages\EditLead;
use Backstage\Crm\Filament\Resources\Leads\Pages\ListLeads;
use Backstage\Crm\Filament\Resources\Leads\Pages\ViewLead;
use Backstage\Crm\Filament\Resources\Leads\Schemas\LeadForm;
use Backstage\Crm\Filament\Resources\Leads\Schemas\LeadInfolist;
use Backstage\Crm\Filament\Resources\Leads\Tables\LeadsTable;
use Backstage\Crm\Filament\Resources\Shared\RelationManagers\TagsRelationManager;
use Backstage\Crm\Models\Lead;
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

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

    public static function getSlug(?Panel $panel = null): string
    {
        return 'crm/leads';
    }

    public static function getNavigationGroup(): string | UnitEnum | null
    {
        return __('CRM - Marketing');
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
        return __('Leads');
    }

    public static function getModelLabel(): string
    {
        return __('Lead');
    }

    public static function form(Schema $schema): Schema
    {
        return LeadForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LeadInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LeadsTable::configure($table);
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
            'index' => ListLeads::route('/'),
            'create' => CreateLead::route('/create'),
            'view' => ViewLead::route('/{record}'),
            'edit' => EditLead::route('/{record}/edit'),
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
