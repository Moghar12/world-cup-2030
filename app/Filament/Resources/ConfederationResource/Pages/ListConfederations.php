<?php

namespace App\Filament\Resources\ConfederationResource\Pages;

use App\Filament\Resources\ConfederationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConfederations extends ListRecords
{
    protected static string $resource = ConfederationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
