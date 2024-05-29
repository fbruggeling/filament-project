<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Type;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Array van willekeurige Nederlandse voornamen
        $voornamen = ['Buddy', 'Luna', 'Max', 'Bella', 'Rocky', 'Molly', 'Charlie', 'Daisy', 'Bailey', 'Lucy', 'Jack', 'Coco', 'Simba', 'Lola', 'Toby', 'Lizzy', 'Sam', 'Gizmo', 'Misty', 'Oscar'];

        // Array van willekeurige statussen
        $statussen = ['alive', 'death']; // changed to lowercase
        $genders = ['male', 'female'];

        // Willekeurige geboortedata genereren (tussen 1 en 15 jaar geleden)
        $startDate = strtotime("-15 years");
        $endDate = strtotime("-1 year");

        // Lijst van diertypes en bijbehorende dierrassen
        $diertypesMetRassen = DB::table('types')
            ->join('breeds', 'types.id', '=', 'breeds.type_id')
            ->select('types.id as type_id', 'breeds.id as breed_id', 'types.type as type_name') // Verander 'types.name' naar 'types.type'
            ->get()
            ->groupBy('type_name')
            ->toArray();

        // Bepaal het aantal eigenaren op basis van de percentages
        $aantalEigenaren = 17;
        $aantalEigenaren1Dier = ceil(0.6 * $aantalEigenaren);
        $aantalEigenaren2Dieren = ceil(0.3 * $aantalEigenaren);
        $aantalEigenaren3Dieren = $aantalEigenaren - $aantalEigenaren1Dier - $aantalEigenaren2Dieren;

        // Genereer eigenaren met het juiste aantal dieren
        $eigenaarIndex = 1;
        for ($i = 0; $i < $aantalEigenaren1Dier; $i++) {
            $this->voegDierToeAanEigenaar($voornamen, $statussen, $genders, $startDate, $endDate, $diertypesMetRassen, $eigenaarIndex, 'male'); // Eigenaar is mannelijk
            $eigenaarIndex++;
        }
        for ($i = 0; $i < $aantalEigenaren2Dieren; $i++) {
            $this->voegDierToeAanEigenaar($voornamen, $statussen, $genders, $startDate, $endDate, $diertypesMetRassen, $eigenaarIndex, 'female'); // Eigenaar is vrouwelijk
            $this->voegDierToeAanEigenaar($voornamen, $statussen, $genders, $startDate, $endDate, $diertypesMetRassen, $eigenaarIndex, 'female'); // Eigenaar is vrouwelijk
            $eigenaarIndex++;
        }
        for ($i = 0; $i < $aantalEigenaren3Dieren; $i++) {
            $this->voegDierToeAanEigenaar($voornamen, $statussen, $genders, $startDate, $endDate, $diertypesMetRassen, $eigenaarIndex, 'male'); // Eigenaar is mannelijk
            $this->voegDierToeAanEigenaar($voornamen, $statussen, $genders, $startDate, $endDate, $diertypesMetRassen, $eigenaarIndex, 'male'); // Eigenaar is mannelijk
            $this->voegDierToeAanEigenaar($voornamen, $statussen, $genders, $startDate, $endDate, $diertypesMetRassen, $eigenaarIndex, 'female'); // Eigenaar is vrouwelijk
            $eigenaarIndex++;
        }
    }

    private function voegDierToeAanEigenaar($voornamen, $statussen, $genders, $startDate, $endDate, $diertypesMetRassen, $eigenaarIndex, $eigenaarGeslacht)
    {
        $randomVoornaam = $voornamen[array_rand($voornamen)];
        $randomStatus = $statussen[array_rand($statussen)];
        $randomGender = $genders[array_rand($genders)];
        $randomGeboortedatum = date('Y-m-d', mt_rand($startDate, $endDate));

        // Willekeurig diertype selecteren
        $randomDiertype = array_rand($diertypesMetRassen);
        $diertypeId = Type::where('type', $randomDiertype)->value('id');
        // Willekeurig dierras selecteren dat bij het diertype hoort
        $randomDierras = collect($diertypesMetRassen[$randomDiertype])->random();
        $dierrasId = $randomDierras->breed_id;

        // Bepaal realistische levensjaren op basis van diertype
        $levensjaren = $this->bepaalRealistischeLevensjaren($randomDiertype);

        // Geslacht van het dier bepalen op basis van de voornaam
        $dierGeslacht = $this->bepaalGeslacht($randomVoornaam);

        // Insert statement voor het dier
        DB::table('animals')->insert([
            'date_of_birth' => $randomGeboortedatum,
            'name' => $randomVoornaam,
            'status' => $randomStatus,
            'gender' => $dierGeslacht, // Geslacht van het dier
            'owner_id' => $eigenaarIndex,
            'type_id' => $diertypeId,
            'breed_id' => $dierrasId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

                // Genereer een realistische datum voor de sterfdatum op basis van de geboortedatum en levensjaren
                $sterfdatum = date('Y-m-d', strtotime("+" . $levensjaren . " years", strtotime($randomGeboortedatum)));

                // Insert statement voor levensduur van het dier
                DB::table('lifespans')->insert([
                    'animal_id' => DB::getPdo()->lastInsertId(),
                    'date_of_birth' => $randomGeboortedatum,
                    'date_of_death' => $sterfdatum,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        
            private function bepaalRealistischeLevensjaren($diertype)
            {
                // Gemiddelde levensverwachting voor verschillende diersoorten (in jaren)
                $gemiddeldeLevensverwachting = [
                    'Hond' => 10,
                    'Kat' => 12,
                    'Konijn' => 8,
                    'Vogel' => 5,
                    'Vis' => 3,
                    'Reptiel' => 15,
                    'Cavia' => 5,
                    'Hamster' => 3,
                    'Fret' => 8,
                    'Paard' => 25,
                ];
        
                // Controleer of het diertype in de lijst van gemiddelde levensverwachtingen voorkomt
                if (array_key_exists($diertype, $gemiddeldeLevensverwachting)) {
                    // Retourneer het gemiddelde levensjaar voor het diertype
                    return $gemiddeldeLevensverwachting[$diertype];
                } else {
                    // Als het diertype niet wordt gevonden, retourneer een standaardwaarde van 10 jaar
                    return 10;
                }
            }
        
            private function bepaalGeslacht($voornaam)
            {
                // Array van voornamen die vaak bij mannen voorkomen
                $mannenNamen = ['Buddy', 'Max', 'Rocky', 'Charlie', 'Bailey', 'Jack', 'Coco', 'Simba', 'Toby', 'Sam', 'Gizmo', 'Oscar'];
        
                // Controleren of de voornaam voorkomt in de lijst met mannen namen
                if (in_array($voornaam, $mannenNamen)) {
                    return 'male'; // Geslacht is mannelijk
                } else {
                    return 'female'; // Geslacht is vrouwelijk
                }
            }
}