<?php

namespace App\Filament\Resources\SquadlistResource\Pages;

use App\Filament\Resources\SquadlistResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSquadlists extends ListRecords
{
    protected static string $resource = SquadlistResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
