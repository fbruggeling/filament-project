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
            $table->string('first_name');
            $table->string('preposition')->nullable();
            $table->string('last_name');
            $table->string('gender');
            $table->string('email');
            $table->string('phone_number');
            $table->string('city');
            $table->string('street');
            $table->string('house_number');
            $table->string('postal_code');
            // $table->foreignId('option_id')->constrained('options')->cascadeOnDelete();
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
