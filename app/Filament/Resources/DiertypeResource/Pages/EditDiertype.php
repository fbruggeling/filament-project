<?php

namespace App\Filament\Resources\DiertypeResource\Pages;

use App\Filament\Resources\DiertypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDiertype extends EditRecord
{
    protected static string $resource = DiertypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
