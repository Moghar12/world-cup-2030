<?php

namespace App\Filament\Resources\fieldResource\Pages;

use App\Filament\Resources\fieldResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class Viewfield extends ViewRecord
{
    protected static string $resource = fieldResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
