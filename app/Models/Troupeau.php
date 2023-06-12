<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Troupeau extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    function ferme(): BelongsTo
    {
        return $this->belongsTo(Ferme::class);
    }

    function espece(): BelongsTo
    {
        return $this->belongsTo(Espece::class);
    }

    function production(): BelongsTo
    {
        return $this->belongsTo(Production::class);
    }
}
