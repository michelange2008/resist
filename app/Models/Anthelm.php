<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anthelm extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function molecules(): BelongsToMany
    {
        return $this->belongsToMany(Molecule::class);
    }

    public function especes(): BelongsToMany
    {
        return $this->belongsToMany(Espece::class)->withPivot('voie', 'posologie', 'lait', 'viande');
    }

    function laboratoire(): BelongsTo
    {
        return $this->belongsTo(Laboratoire::class);    
    }

    function tests(): HasMany
    {
        return $this->hasMany(Test::class);    
    }
}
