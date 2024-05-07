<?php

namespace App\Filament\Resources\DierrasResource\Pages;

use App\Filament\Resources\DierrasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDierras extends ListRecords
{
    protected static string $resource = DierrasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
