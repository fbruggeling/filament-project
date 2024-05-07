<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class diertype extends Model
{
    use HasFactory;

    public function dierras(): HasMany
    {
        return $this->hasMany(dierras::class);
    }

    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class);
    }
}
