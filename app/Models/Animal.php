<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
// use Spatie\Translatable\HasTranslations;

class Animal extends Model
{
    use HasFactory;

    // public Owner $owner;

    // use HasTranslations;

    // public $translatable = ['name, date_of_birth, type, breed, status'];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }

    public function treatments(): BelongsToMany
    {
        return $this->belongsToMany(Treatment::class, 'animal-treatment')->withTimestamps();
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class);
    }

    public function consults(): BelongsToMany
    {
        return $this->belongsToMany(Consult::class, 'animal-consult')->withTimestamps();
    }
}
