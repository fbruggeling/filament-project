<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Option extends Model
{
    use HasFactory;

    public function animal(): BelongsToMany
    {
        return $this->belongsToMany(Animal::class, 'animal-option');
    }

    public function owner(): BelongsToMany
    {
        return $this->belongsToMany(Owner::class, 'owner-option');
    }

    public function consult(): BelongsToMany
    {
        return $this->belongsToMany(Consult::class, 'consult-option');
    }
}
