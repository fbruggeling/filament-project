<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Array van willekeurige Nederlandse voornamen
        $voornamen = ['Buddy', 'Luna', 'Max', 'Bella', 'Rocky', 'Molly', 'Charlie', 'Daisy', 'Bailey', 'Lucy'];

        // Array van willekeurige statussen
        $statussen = ['Gezond', 'In behandeling', 'Afgemeld'];

        // Willekeurige geboortedata genereren (tussen 1 en 15 jaar geleden)
        $startDate = strtotime("-15 years");
        $endDate = strtotime("-1 year");

        // Lijst van diertypes en bijbehorende dierrassen
        $diertypesMetRassen = DB::table('diertypes')
            ->join('dierras', 'diertypes.id', '=', 'dierras.diertype_id')
            ->select('diertypes.id as diertype_id', 'dierras.id as dierras_id')
            ->get()
            ->groupBy('diertype_id')
            ->toArray();

        // Loop om 10 willekeurige patiënten (huisdieren) in te voegen
        for ($i = 0; $i < 10; $i++) {
            $randomVoornaam = $voornamen[array_rand($voornamen)];
            $randomStatus = $statussen[array_rand($statussen)];
            $randomGeboortedatum = date('Y-m-d', mt_rand($startDate, $endDate));

            // Willekeurig diertype selecteren
            $randomDiertype = array_rand($diertypesMetRassen);
            $diertypeId = $randomDiertype;
            // Willekeurig dierras selecteren dat bij het diertype hoort
            $randomDierras = collect($diertypesMetRassen[$randomDiertype])->random();
            $dierrasId = $randomDierras->dierras_id;

            DB::table('patients')->insert([
                'date_of_birth' => $randomGeboortedatum,
                'name' => $randomVoornaam,
                'status' => $randomStatus,
                'owner_id' => mt_rand(1, 10), // Willekeurige eigenaar ID tussen 1 en 10
                'diertype_id' => $diertypeId,
                'dierras_id' => $dierrasId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
