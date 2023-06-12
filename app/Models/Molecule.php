<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Molecule extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function anthelms(): BelongsToMany
    {
        return $this->belongsToMany(Anthelm::class);
    }
}
