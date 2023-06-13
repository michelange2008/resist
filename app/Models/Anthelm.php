<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Anthelm extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function molecules(): BelongsToMany
    {
        return $this->belongsToMany(Molecule::class);
    }

    function laboratoire(): BelongsTo
    {
        return $this->belongsTo(Laboratoire::class);    
    }
}
