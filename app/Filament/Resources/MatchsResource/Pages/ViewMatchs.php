<?php

namespace App\Filament\Resources\MatchsResource\Pages;

use App\Filament\Resources\MatchsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMatchs extends ViewRecord
{
    protected static string $resource = MatchsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
