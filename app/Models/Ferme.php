<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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

    function tests() : HasManyThrough
    {
        return $this->throughTroupeaus()->hasTests();
    }

    function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

 }
