<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiertypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $types = [
            'Hond',
            'Kat',
            'Konijn',
            'Vogel',
            'Vis',
            'Reptiel',
            'Cavia',
            'Hamster',
            'Fret',
            'Paard',
        ];

        foreach ($types as $type) {
            DB::table('diertypes')->insert([
                'type' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
