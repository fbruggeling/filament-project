<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PatientTypeOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // Stat::make('Katten', Patient::query()->where('type', 'kat')->count()),
            // Stat::make('Honden', Patient::query()->where('type', 'hond')->count()),
            // Stat::make('Konijnen', Patient::query()->where('type', 'konijn')->count()),
            // Stat::make('Vissen', Patient::query()->where('type', 'fish')->count()),
            // Stat::make('Other', Patient::query()->where('type', 'other')->count()),
        ];
    }
}
