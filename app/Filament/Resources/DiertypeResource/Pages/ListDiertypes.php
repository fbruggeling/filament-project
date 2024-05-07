<?php

namespace App\Filament\Resources\DiertypeResource\Pages;

use App\Filament\Resources\DiertypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDiertypes extends ListRecords
{
    protected static string $resource = DiertypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
