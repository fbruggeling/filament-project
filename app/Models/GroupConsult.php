<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupConsult extends Model
{
    use HasFactory;

    public function consult(): HasOne
    {
        return $this->hasOne(Consult::class);
    }
}
