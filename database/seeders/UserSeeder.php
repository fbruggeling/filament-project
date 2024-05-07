<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Seed users table
        DB::table('users')->insert([
            'name' => 'Fedor',
            'email' => 'fbruggeling01@gmail.com',
            'password' => bcrypt('root'), // Vervang 'wachtwoord' door het gewenste wachtwoord
        ]);
    }
    
}
