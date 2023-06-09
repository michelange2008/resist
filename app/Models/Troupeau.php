<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Troupeau extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    function ferme() {
        return $this->belongsTo(Ferme::class);
    }

    function espece() {
        return $this->belongsTo(Espece::class);
    }

    function production() {
        return $this->belongsTo(Production::class);
    }
}
