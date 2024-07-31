<?php

namespace App\Filament\Resources\ConfederationResource\Pages;

use App\Filament\Resources\ConfederationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewConfederation extends ViewRecord
{
    protected static string $resource = ConfederationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
