<?php

namespace Database\Seeders;

use App\Models\Treatment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UserSeeder::class);
        $this->call(OwnerSeeder::class);
        $this->call(TreatmentSeeder::class);
        $this->call(DiertypeSeeder::class);
        $this->call(DierrasSeeder::class);
        $this->call(PatientSeeder::class);
    }
}
