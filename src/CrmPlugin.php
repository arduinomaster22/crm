<?php

namespace Backstage\Crm;

use Backstage\Crm\Filament\Resources\ContactMoments\ContactMomentResource;
use Backstage\Crm\Filament\Resources\Contacts\ContactResource;
use Backstage\Crm\Filament\Resources\Departments\DepartmentResource;
use Backstage\Crm\Filament\Resources\Leads\LeadResource;
use Backstage\Crm\Filament\Resources\Organizations\OrganizationResource;
use Filament\Contracts\Plugin;
use Filament\Panel;

class CrmPlugin implements Plugin
{
    public function getId(): string
    {
        return 'crm';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            OrganizationResource::class,

            DepartmentResource::class,

            LeadResource::class,

            ContactResource::class,

            ContactMomentResource::class,
        ]);

        $panel->pages([
            \Backstage\Crm\Filament\Pages\CrmDashboard::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
