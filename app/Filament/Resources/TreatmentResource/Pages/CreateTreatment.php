<?php

namespace App\Filament\Resources\TreatmentResource\Pages;

use App\Filament\Resources\TreatmentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTreatment extends CreateRecord
{
    // use CreateRecord\Concerns\Translatable;
 
    protected function getHeaderActions(): array
    {
        return [
            // Actions\LocaleSwitcher::make(),
            // ...
        ];
    }

    protected static string $resource = TreatmentResource::class;
}
