<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $rassen = [
            'Hond' => ['Labrador Retriever', 'Duitse Herder', 'Golden Retriever'],
            'Kat' => ['Maine Coon', 'Britse Korthaar', 'Siamees'],
            'Konijn' => ['Hollander', 'Dwergkonijn', 'Vlaamse Reus'],
            'Vogel' => ['Kanarie', 'Parkiet', 'Papegaai'],
            'Vis' => ['Goudvis', 'Zwaarddrager', 'Neontetra'],
            'Reptiel' => ['Korenslang', 'Baardagaam', 'Roodwangschildpad'],
            'Cavia' => ['Abyssinian', 'Peruvian', 'Texel'],
            'Hamster' => ['Syrische hamster', 'Russische dwerghamster', 'Chinese dwerghamster'],
            'Fret' => ['Albino fret', 'Sable fret', 'Zilveren fret'],
            'Paard' => ['Shetlandpony', 'Fries', 'KWPN'],
        ];

        foreach ($rassen as $diertype => $rassenVanDitType) {
            $diertypeId = DB::table('types')->where('type', $diertype)->value('id');

            foreach ($rassenVanDitType as $ras) {
                DB::table('breeds')->insert([
                    'breed' => $ras,
                    'type_id' => $diertypeId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
