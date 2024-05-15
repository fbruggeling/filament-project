<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Consult;
use App\Models\Animal;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('animal-consult', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Animal::class);
            $table->foreignIdFor(Consult::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animal-consult');
    }
};
