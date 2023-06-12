<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voie extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function anthelm_especes(): HasMany
    {
        return $this->hasMany(Anthelm_Espece::class);
    }
}
