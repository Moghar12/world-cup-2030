<?php

namespace App\Filament\Resources\RefereeResource\Pages;

use App\Filament\Resources\RefereeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReferee extends EditRecord
{
    protected static string $resource = RefereeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
