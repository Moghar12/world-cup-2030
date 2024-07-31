<?php

namespace App\Filament\Resources\fieldResource\Pages;

use App\Filament\Resources\fieldResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class Listfield extends ListRecords
{
    protected static string $resource = fieldResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
