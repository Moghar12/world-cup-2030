<?php

namespace App\Filament\Resources\SquadlistResource\Pages;

use App\Filament\Resources\SquadlistResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSquadlist extends ViewRecord
{
    protected static string $resource = SquadlistResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
