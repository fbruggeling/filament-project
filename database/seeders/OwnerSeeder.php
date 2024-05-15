<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Array van willekeurige Nederlandse voornamen
        $voornamen = ['Daan', 'Emma', 'Lucas', 'Sophie', 'Sem', 'Julia', 'Finn', 'Mila', 'Luuk', 'Zoë'];

        // Array van willekeurige Nederlandse achternamen
        $achternamen = ['de Jong', 'Jansen', 'de Vries', 'van den Berg', 'van Dijk', 'Bakker', 'Visser', 'Smit', 'Meijer', 'de Boer'];

        // Willekeurige adressen genereren
        $addresses = [
            ['Amsterdam', 'Damstraat', '12', '1234AB'],
            ['Rotterdam', 'Zuidplein', '45', '5678CD'],
            ['Utrecht', 'Voorstraat', '78', '9012EF'],
            ['Den Haag', 'Hofweg', '3', '3456GH'],
            ['Eindhoven', 'Markt', '56', '7890IJ'],
            ['Groningen', 'Grote Markt', '9', '2345KL'],
            ['Maastricht', 'Vrijthof', '34', '6789MN'],
            ['Haarlem', 'Grote Houtstraat', '21', '0123OP'],
            ['Breda', 'Wilhelminastraat', '67', '4567QR'],
            ['Amersfoort', 'Langestraat', '90', '8901ST']
        ];

        $genders = [
            'male', 'female', 'other'
        ];

        // Houd bij welke adressen al gebruikt zijn
        $usedAddresses = [];

        // Loop om 10 willekeurige eigenaren in te voegen
        for ($i = 0; $i < 10; $i++) {
            $randomVoornaam = $voornamen[array_rand($voornamen)];
            $randomAchternaam = $achternamen[array_rand($achternamen)];
            $randomgender= $genders[array_rand($genders)];

            // Controleer of het adres al in gebruik is
            do {
                $randomAddressKey = array_rand($addresses);
                $randomAddress = $addresses[$randomAddressKey];
            } while (in_array($randomAddressKey, $usedAddresses));

            // Voeg het adres toe aan de lijst van gebruikte adressen
            $usedAddresses[] = $randomAddressKey;

            DB::table('owners')->insert([
                'first_name' => $randomVoornaam,
                'preposition' => null, // Hier kan je logica toevoegen om een willekeurig tussenvoegsel te kiezen
                'last_name' => $randomAchternaam,
                'gender' => $randomgender,
                'email' => strtolower($randomVoornaam) . '@example.com',
                'phone_number' => '06' . mt_rand(10000000, 99999999), // Genereer een willekeurig telefoonnummer
                'city' => $randomAddress[0],
                'street' => $randomAddress[1],
                'house_number' => $randomAddress[2],
                'postal_code' => $randomAddress[3],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
