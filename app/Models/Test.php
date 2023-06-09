<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Test extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $dates = ['T0', 'T1'];
    protected $guarded = [];

    function troupeau(): BelongsTo
    {
        return $this->belongsTo(Troupeau::class);    
    }

    function animals(): BelongsToMany
    {
        return $this->belongsToMany(Animal::class);    
    }

    function anthelm(): BelongsTo
    {
        return $this->belongsTo(Anthelm::class);    
    }

    function typetest() : BelongsTo 
    {
        return $this->belongsTo(Typetest::class);
    }

}
