<?php

namespace App\Filament\Resources\DierrasResource\Pages;

use App\Filament\Resources\DierrasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDierras extends EditRecord
{
    protected static string $resource = DierrasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
