<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Animal extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    function troupeau() : BelongsTo {
        return $this->belongsTo(Troupeau::class);
    }

    function tests(): BelongsToMany 
    {
        return $this->belongsToMany(Test::class);    
    }
}
