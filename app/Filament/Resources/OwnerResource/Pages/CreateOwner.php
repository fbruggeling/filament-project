<?php

namespace App\Filament\Resources\OwnerResource\Pages;

use App\Filament\Resources\OwnerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;


class CreateOwner extends CreateRecord
{
    // use CreateRecord\Concerns\Translatable;
 
    protected function getHeaderActions(): array
    {
        return [
            // Actions\LocaleSwitcher::make(),
            // ...
        ];
    }

    protected static string $resource = OwnerResource::class;
}
