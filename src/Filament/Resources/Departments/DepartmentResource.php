<?php

namespace Backstage\Crm\Filament\Resources\Departments;

use BackedEnum;
use Backstage\Crm\Filament\Resources\Departments\Pages\CreateDepartment;
use Backstage\Crm\Filament\Resources\Departments\Pages\EditDepartment;
use Backstage\Crm\Filament\Resources\Departments\Pages\ListDepartments;
use Backstage\Crm\Filament\Resources\Departments\Pages\ViewDepartment;
use Backstage\Crm\Filament\Resources\Departments\Schemas\DepartmentForm;
use Backstage\Crm\Filament\Resources\Departments\Schemas\DepartmentInfolist;
use Backstage\Crm\Filament\Resources\Departments\Tables\DepartmentsTable;
use Backstage\Crm\Filament\Resources\Shared\RelationManagers\ContactMomentsRelationManager;
use Backstage\Crm\Filament\Resources\Shared\RelationManagers\TagsRelationManager;
use Backstage\Crm\Models\Department;
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

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    public static function getSlug(?Panel $panel = null): string
    {
        return 'crm/departments';
    }

    public static function getNavigationGroup(): string | UnitEnum | null
    {
        return __('CRM - Relations');
    }

    public static function getNavigationIcon(): string | BackedEnum | Htmlable | null
    {
        return Heroicon::OutlinedBuildingOffice;
    }

    public static function getActiveNavigationIcon(): string | BackedEnum | Htmlable | null
    {
        return Heroicon::BuildingOffice;
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
        return __('Departments');
    }

    public static function getModelLabel(): string
    {
        return __('Department');
    }

    public static function form(Schema $schema): Schema
    {
        return DepartmentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DepartmentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DepartmentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            TagsRelationManager::class,

            ContactMomentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDepartments::route('/'),
            'create' => CreateDepartment::route('/create'),
            'view' => ViewDepartment::route('/{record}'),
            'edit' => EditDepartment::route('/{record}/edit'),
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
