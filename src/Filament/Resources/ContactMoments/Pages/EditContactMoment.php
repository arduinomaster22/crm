<?php

namespace Backstage\Crm\Filament\Resources\ContactMoments\Pages;

use Backstage\Crm\Filament\Resources\ContactMoments\ContactMomentResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditContactMoment extends EditRecord
{
    protected static string $resource = ContactMomentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),

            DeleteAction::make(),

            ForceDeleteAction::make(),

            RestoreAction::make(),
        ];
    }
}
