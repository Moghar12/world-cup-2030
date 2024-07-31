<?php

namespace App\Filament\Resources\MatchsResource\Pages;

use App\Filament\Resources\MatchsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMatchs extends ListRecords
{
    protected static string $resource = MatchsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
