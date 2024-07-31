<?php

namespace App\Filament\Resources\MatchsResource\Pages;

use App\Filament\Resources\MatchsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMatchs extends EditRecord
{
    protected static string $resource = MatchsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
