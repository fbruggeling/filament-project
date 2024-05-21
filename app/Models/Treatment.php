<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Casts\MoneyCast;
// use Spatie\Translatable\HasTranslations;

class Treatment extends Model
{
    use HasFactory;

    // use HasTranslations;

    // public $translatable = ['treatment, notes, price, created_at'];

    protected $casts = [
        'price' => MoneyCast::class,
    ];

    public function consults(): BelongsToMany
    {
        return $this->belongsToMany(Consult::class, 'consult-treatment')->withTimestamps();
    }
}
