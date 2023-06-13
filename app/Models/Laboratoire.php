<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laboratoire extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    function anthelms(): HasMany
    {
        return $this->hasMany(Anthelm::class);    
    }
}
