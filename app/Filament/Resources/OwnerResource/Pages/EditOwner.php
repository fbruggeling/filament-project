<?php

namespace App\Filament\Resources\OwnerResource\Pages;

use App\Filament\Resources\OwnerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOwner extends EditRecord
{   
    // use EditRecord\Concerns\Translatable;

    protected static string $resource = OwnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            // Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
}
