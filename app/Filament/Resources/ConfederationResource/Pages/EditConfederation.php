<?php

namespace App\Filament\Resources\ConfederationResource\Pages;

use App\Filament\Resources\ConfederationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConfederation extends EditRecord
{
    protected static string $resource = ConfederationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
