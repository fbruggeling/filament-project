<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\BelongsToRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class dierras extends Model
{
    use HasFactory;

    public function diertype(): BelongsTo
    {
        return $this->belongsTo(diertype::class);
    }

        public function patients(): HasMany
    {
        return $this->hasMany(Patient::class);
    }

}
