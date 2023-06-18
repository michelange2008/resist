<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ferme extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    function troupeaus(): HasMany 
    {
        return $this->hasMany(Troupeau::class);
    }

    function commune(): BelongsTo
    {
        return $this->belongsTo(Commune::class);
    }

 }
