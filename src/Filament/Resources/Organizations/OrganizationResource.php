<?php

namespace Backstage\Crm\Filament\Resources\Organizations;

use BackedEnum;
use Backstage\Crm\Filament\Resources\Organizations\Pages\CreateOrganization;
use Backstage\Crm\Filament\Resources\Organizations\Pages\EditOrganization;
use Backstage\Crm\Filament\Resources\Organizations\Pages\ListOrganizations;
use Backstage\Crm\Filament\Resources\Organizations\Pages\ViewOrganization;
use Backstage\Crm\Filament\Resources\Organizations\RelationManagers\ContactsRelationManager;
use Backstage\Crm\Filament\Resources\Organizations\RelationManagers\DepartmentsRelationManager;
use Backstage\Crm\Filament\Resources\Organizations\RelationManagers\LeadsRelationManager;
use Backstage\Crm\Filament\Resources\Organizations\Schemas\OrganizationForm;
use Backstage\Crm\Filament\Resources\Organizations\Schemas\OrganizationInfolist;
use Backstage\Crm\Filament\Resources\Organizations\Tables\OrganizationsTable;
use Backstage\Crm\Filament\Resources\Shared\RelationManagers\ContactMomentsRelationManager;
use Backstage\Crm\Filament\Resources\Shared\RelationManagers\TagsRelationManager;
use Backstage\Crm\Models\Organization;
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

class OrganizationResource extends Resource
{
    protected static ?string $model = Organization::class;

    public static function getSlug(?Panel $panel = null): string
    {
        return 'crm/organizations';
    }

    public static function getNavigationGroup(): string | UnitEnum | null
    {
        return __('CRM - Relations');
    }

    public static function getNavigationIcon(): string | BackedEnum | Htmlable | null
    {
        return Heroicon::OutlinedBuildingOffice2;
    }

    public static function getActiveNavigationIcon(): string | BackedEnum | Htmlable | null
    {
        return Heroicon::BuildingOffice2;
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
        return __('Organizations');
    }

    public static function getModelLabel(): string
    {
        return __('Organization');
    }

    public static function form(Schema $schema): Schema
    {
        return OrganizationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OrganizationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrganizationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            TagsRelationManager::class,

            DepartmentsRelationManager::class,

            LeadsRelationManager::class,

            ContactsRelationManager::class,

            ContactMomentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrganizations::route('/'),
            'create' => CreateOrganization::route('/create'),
            'view' => ViewOrganization::route('/{record}'),
            'edit' => EditOrganization::route('/{record}/edit'),
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
