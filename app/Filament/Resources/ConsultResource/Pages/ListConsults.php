<?php

namespace App\Filament\Resources\ConsultResource\Pages;

use App\Filament\Resources\ConsultResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConsults extends ListRecords
{
    protected static string $resource = ConsultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
