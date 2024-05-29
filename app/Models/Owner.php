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

    // protected $appends = ['full_name'];

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }

    public function consult(): HasMany
    {
        return $this->hasMany(Consult::class);
    }

    public function option(): HasMany
    {
        return $this->hasMany(Option::class);
    }

    // Accessor voor volledige naam
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->preposition} {$this->last_name}";
    }

    // Scope om volledige naam te selecteren
    public function scopeWithFullName($query)
    {
        return $query->selectRaw("*, CONCAT(first_name, ' ', preposition, ' ', last_name) as full_name");
    }
}
