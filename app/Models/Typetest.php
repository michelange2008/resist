<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Typetest extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    function tests() : HasMany {
        return $this->hasMany(Test::class);
    }
}
