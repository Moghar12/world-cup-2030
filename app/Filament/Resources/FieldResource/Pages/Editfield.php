<?php

namespace App\Filament\Resources\fieldResource\Pages;

use App\Filament\Resources\fieldResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class Editfield extends EditRecord
{
    protected static string $resource = fieldResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
