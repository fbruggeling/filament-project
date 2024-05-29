<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Owner extends Model
{
    use HasFactory;

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }

    public function consult(): HasMany
    {
        return $this->hasMany(Consult::class);
    }

    public function option(): BelongsToMany
    {
        return $this->belongsToMany(Option::class, 'owner-option');
    }
}
