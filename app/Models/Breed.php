<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
// use Spatie\Translatable\HasTranslations;

class Breed extends Model
{
    use HasFactory;

    // use HasTranslations;

    // public $translatable = ['breed, type_id'];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

        public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }
}
