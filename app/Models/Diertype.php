<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Diertype extends Model
{
    use HasFactory;

    public function dierras(): HasMany 
    {
        return $this->hasMany(Dierras::class);
    }

    public function patients(): HasOne
    {
        return $this->hasOne(Patient::class);
    }
}
