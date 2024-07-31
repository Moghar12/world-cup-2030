<?php

namespace App\Filament\Resources\SquadlistResource\Pages;

use App\Filament\Resources\SquadlistResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSquadlist extends EditRecord
{
    protected static string $resource = SquadlistResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
