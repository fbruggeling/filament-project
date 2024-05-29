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
        // Array van willekeurige Nederlandse voornamen met geslacht
        $namen = [
            ['Daan', 'male'],
            ['Emma', 'female'],
            ['Lucas', 'male'],
            ['Sophie', 'female'],
            ['Sem', 'male'],
            ['Julia', 'female'],
            ['Finn', 'male'],
            ['Mila', 'female'],
            ['Luuk', 'male'],
            ['Zoë', 'female'],
            ['Noah', 'male'],
            ['Tess', 'female'],
            ['Levi', 'male'],
            ['Sara', 'female'],
            ['Bram', 'male'],
            ['Lotte', 'female'],
            ['Max', 'male']
        ];

        // Array van willekeurige Nederlandse achternamen zonder tussenvoegsels
        $achternamen = ['Jong', 'Jansen', 'Vries', 'Berg', 'Dijk', 'Bakker', 'Visser', 'Smit', 'Meijer', 'Boer', 'Mulder', 'Bos', 'Vos', 'Peters', 'Hendriks', 'Kramer', 'Leeuwen'];

        // Array van tussenvoegsels
        $prepositions = ['', 'van', 'van der', 'van den', 'van de', 'de'];

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
            ['Amersfoort', 'Langestraat', '90', '8901ST'],
            ['Nijmegen', 'Molenstraat', '13', '1011AA'],
            ['Leiden', 'Breestraat', '22', '1022BB'],
            ['Delft', 'Oude Delft', '33', '1033CC'],
            ['Tilburg', 'Heuvelstraat', '44', '1044DD'],
            ['Arnhem', 'Jansstraat', '55', '1055EE'],
            ['Zwolle', 'Melkmarkt', '66', '1066FF'],
            ['Apeldoorn', 'Hoofdstraat', '77', '1077GG']
        ];

        // Set van letters voor huisnummers
        $letters = range('A', 'H');

        // Houd bij welke adressen al gebruikt zijn
        $usedAddresses = [];

        // Houd bij welke huisnummers een letter moeten hebben
        $addressKeysWithLetter = array_rand($addresses, mt_rand(2, 3));

        // Als slechts één adres is geselecteerd, maak er een array van
        if (!is_array($addressKeysWithLetter)) {
            $addressKeysWithLetter = [$addressKeysWithLetter];
        }

        // Haal de mogelijke genders uit de database
        $genders = DB::table('options')
            ->where('optionname', 'OwnerGender')
            ->pluck('optionvalue')
            ->toArray();

        // Functie om een willekeurig e-mailadres te genereren
        function generateRandomEmail($firstName, $lastName)
        {
            $domains = ['example.com', 'email.com', 'test.com'];
            $patterns = [
                strtolower($firstName) . '.' . strtolower($lastName),
                strtolower($firstName) . mt_rand(100, 999),
                strtolower($lastName) . mt_rand(100, 999),
                strtolower($firstName[0]) . '.' . strtolower($lastName),
                strtolower($firstName) . '_' . strtolower($lastName),
                substr(strtolower($firstName), 0, 3) . mt_rand(1000, 9999),
                substr(strtolower($lastName), 0, 3) . mt_rand(1000, 9999)
            ];
            do {
                $email = mb_convert_encoding($patterns[array_rand($patterns)] . '@' . $domains[array_rand($domains)], 'UTF-8');
            } while (mb_strlen($email) < 8); // Zorg ervoor dat het e-mailadres minstens 8 tekens lang is
            return $email;
        }

        // Loop om 17 willekeurige eigenaren in te voegen
        for ($i = 0; $i < 17; $i++) {
            // Willekeurige voornaam en geslacht selecteren
            [$randomVoornaam, $gender] = $namen[$i];

            // Voeg tussenvoegsel toe aan de achternaam
            $randomAchternaam = $achternamen[array_rand($achternamen)];

            // Willekeurig geslacht kiezen uit de database opties
            $randomGender = $genders[array_rand($genders)];

            // Willekeurig tussenvoegsel kiezen
            $randomPreposition = $prepositions[array_rand($prepositions)];

            // Controleer of het adres al in gebruik is
            do {
                $randomAddressKey = array_rand($addresses);
                $randomAddress = $addresses[$randomAddressKey];
            } while (in_array($randomAddressKey, $usedAddresses));

            // Voeg het adres toe aan de lijst van gebruikte adressen
            $usedAddresses[] = $randomAddressKey;

            // Voeg een letter toe aan het huisnummer als dit adres is geselecteerd
            $houseNumber = $randomAddress[2];
            if (in_array($randomAddressKey, $addressKeysWithLetter)) {
                $houseNumber .= $letters[array_rand($letters)];
            }

            DB::table('owners')->insert([
                'first_name' => $randomVoornaam,
                'preposition' => $randomPreposition,
                'last_name' => $randomAchternaam,
                'gender' => $randomGender,
                'email' => generateRandomEmail($randomVoornaam, $randomAchternaam), // Genereer een willekeurig e-mailadres
                'phone_number' => '06' . mt_rand(10000000, 99999999), // Genereer een willekeurig telefoonnummer
                'city' => $randomAddress[0],
                'street' => $randomAddress[1],
                'house_number' => $houseNumber, // Huisnummer met mogelijk een letter
                'postal_code' => $randomAddress[3],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
