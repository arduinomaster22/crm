<?php

namespace Backstage\Crm\Filament\Resources\ContactMoments\Pages;

use Backstage\Crm\Filament\Resources\ContactMoments\ContactMomentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewContactMoment extends ViewRecord
{
    protected static string $resource = ContactMomentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
