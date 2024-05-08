<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $treatments = [
            [
                'treatment' => 'Vaccinatie',
                'notes' => 'Vaccinatie tegen veelvoorkomende ziekten zoals hondenziekte, parvovirus en kattenziekte.',
                'price' => 4500, // In centen, bijv. €45.00
                'duration' => 15, // In minuten
            ],
            [
                'treatment' => 'Consult',
                'notes' => 'Algemene controle en advies over de gezondheid en het welzijn van het huisdier.',
                'price' => 3500, // In centen, bijv. €35.00
                'duration' => 30, // In minuten
            ],
            [
                'treatment' => 'Gebitsreiniging',
                'notes' => 'Reiniging van het gebit en tandsteenverwijdering bij huisdieren.',
                'price' => 6000, // In centen, bijv. €60.00
                'duration' => 45, // In minuten
            ],
            [
                'treatment' => 'Bloedonderzoek',
                'notes' => 'Analyse van bloedmonsters om de gezondheid van het huisdier te evalueren en ziekten op te sporen.',
                'price' => 5500, // In centen, bijv. €55.00
                'duration' => 60, // In minuten
            ],
            [
                'treatment' => 'Operatie',
                'notes' => 'Chirurgische ingreep voor verschillende aandoeningen zoals sterilisatie, castratie, en tumoren verwijderen.',
                'price' => 15000, // In centen, bijv. €150.00
                'duration' => 120, // In minuten
            ],
            [
                'treatment' => 'Inentingen voor konijnen',
                'notes' => 'Vaccinatie tegen myxomatose en RHD (rabbit hemorrhagic disease).',
                'price' => 4000, // In centen, bijv. €40.00
                'duration' => 20, // In minuten
            ],
            [
                'treatment' => 'Ontworming',
                'notes' => 'Behandeling om wormen bij huisdieren te verwijderen en te voorkomen.',
                'price' => 2500, // In centen, bijv. €25.00
                'duration' => 15, // In minuten
            ],
            [
                'treatment' => 'Huidschraapsel',
                'notes' => 'Microscopisch onderzoek van de huid om parasieten zoals mijten en schimmelinfecties te diagnosticeren.',
                'price' => 3000, // In centen, bijv. €30.00
                'duration' => 25, // In minuten
            ],
            [
                'treatment' => 'Oogonderzoek',
                'notes' => 'Onderzoek van de ogen om oogproblemen zoals ontstekingen en letsels te identificeren.',
                'price' => 4000, // In centen, bijv. €40.00
                'duration' => 30, // In minuten
            ],
            [
                'treatment' => 'Echo',
                'notes' => 'Ultrageluidonderzoek om inwendige structuren en organen te bekijken, zoals bij drachtigheidscontrole.',
                'price' => 7000, // In centen, bijv. €70.00
                'duration' => 45, // In minuten
            ],
        ];

        // Loop om 10 willekeurige behandelingen in te voegen
        foreach ($treatments as $treatment) {
            DB::table('treatments')->insert([
                'treatment' => $treatment['treatment'],
                'notes' => $treatment['notes'],
                'price' => $treatment['price'],
                'duration' => $treatment['duration'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
