<?php

namespace App\Filament\Resources\RefereeResource\Pages;

use App\Filament\Resources\RefereeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewReferee extends ViewRecord
{
    protected static string $resource = RefereeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
