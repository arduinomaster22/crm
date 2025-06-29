<?php

namespace Backstage\Crm\Filament\Resources\ContactMoments\Pages;

use Backstage\Crm\Filament\Resources\ContactMoments\ContactMomentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContactMoments extends ListRecords
{
    protected static string $resource = ContactMomentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
