<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnimalSeeder extends Seeder
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
        $genders = ['male', 'female'];

        // Willekeurige geboortedata genereren (tussen 1 en 15 jaar geleden)
        $startDate = strtotime("-15 years");
        $endDate = strtotime("-1 year");

        // Lijst van diertypes en bijbehorende dierrassen
        $diertypesMetRassen = DB::table('types')
            ->join('breeds', 'types.id', '=', 'breeds.type_id')
            ->select('types.id as type_id', 'breeds.id as breed_id')
            ->get()
            ->groupBy('type_id')
            ->toArray();

        // Loop om 10 willekeurige patiënten (huisdieren) in te voegen
        for ($i = 0; $i < 10; $i++) {
            $randomVoornaam = $voornamen[array_rand($voornamen)];
            $randomStatus = $statussen[array_rand($statussen)];
            $randomGender = $genders[array_rand($genders)];
            $randomGeboortedatum = date('Y-m-d', mt_rand($startDate, $endDate));

            // Willekeurig diertype selecteren
            $randomDiertype = array_rand($diertypesMetRassen);
            $diertypeId = $randomDiertype;
            // Willekeurig dierras selecteren dat bij het diertype hoort
            $randomDierras = collect($diertypesMetRassen[$randomDiertype])->random();
            $dierrasId = $randomDierras->breed_id;

            DB::table('animals')->insert([
                'date_of_birth' => $randomGeboortedatum,
                'name' => $randomVoornaam,
                'status' => $randomStatus,
                'gender' => $randomGender,
                'owner_id' => mt_rand(1, 10), // Willekeurige eigenaar ID tussen 1 en 10
                'type_id' => $diertypeId,
                'breed_id' => $dierrasId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
