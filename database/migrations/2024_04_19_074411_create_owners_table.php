<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->string('Voornaam');
            $table->string('Tussenvoegsel');
            $table->string('Achternaam');
            $table->string('Emailadres');
            $table->string('Telefoonnummer');
            $table->string('Woonplaats');
            $table->string('Straat');
            $table->string('Huisnummer');
            $table->string('Postcode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owners');
    }
};
