<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Espece extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function troupeaus(): HasMany
    {
        return $this->hasMany(Troupeau::class);
    }

    function anthelms() : BelongsToMany {
        return $this->belongsToMany(Anthelm::class)->withPivot('voie_id', 'posologie', 'unite_id', 'lait', 'viande');
    }

    function tests() : HasManyThrough {
        return $this->hasManyThrough(Test::class, Troupeau::class);
    }
}
