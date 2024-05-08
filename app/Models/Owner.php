<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
// use Spatie\Translatable\HasTranslations;

class Owner extends Model
{
    use HasFactory;

    // use HasTranslations;

    // public $translatable = ['first_name, preposition, last_name, email, phone_number, city, street, house_number, postal_code'];

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }
}
