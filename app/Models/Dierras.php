<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dierras extends Model
{
    use HasFactory;

    public function diertype(): BelongsTo
    {
        return $this->belongsTo(Diertype::class);
    }
}
