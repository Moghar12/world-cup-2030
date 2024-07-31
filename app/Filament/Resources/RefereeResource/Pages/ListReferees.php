<?php

namespace App\Filament\Resources\RefereeResource\Pages;

use App\Filament\Resources\RefereeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReferees extends ListRecords
{
    protected static string $resource = RefereeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
