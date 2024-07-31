<?php

namespace App\Filament\Resources\CoachResource\Pages;

use App\Filament\Resources\CoachResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCoach extends ViewRecord
{
    protected static string $resource = CoachResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
