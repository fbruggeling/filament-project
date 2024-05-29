<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = [
            ['optionname' => 'AnimalGender', 'optionvalue' => 'Male'],
            ['optionname' => 'AnimalGender', 'optionvalue' => 'Female'],
            ['optionname' => 'OwnerGender', 'optionvalue' => 'Male'],
            ['optionname' => 'OwnerGender', 'optionvalue' => 'Female'],
            ['optionname' => 'OwnerGender', 'optionvalue' => 'Other'],
            ['optionname' => 'AnimalStatus', 'optionvalue' => 'Alive'],
            ['optionname' => 'AnimalStatus', 'optionvalue' => 'Deceased'],
            ['optionname' => 'ConsultStatus', 'optionvalue' => 'Planned'],
            ['optionname' => 'ConsultStatus', 'optionvalue' => 'In Treatment'],
            ['optionname' => 'ConsultStatus', 'optionvalue' => 'Done'],
        ];

        foreach ($options as $option) {
            DB::table('options')->insert([
                'optionname' => $option['optionname'],
                'optionvalue' => $option['optionvalue'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
