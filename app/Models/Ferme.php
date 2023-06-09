<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ferme extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    function troupeaus() {
        return $this->hasMany(Troupeau::class);
    }

    function commune() {
        return $this->belongsTo(Insee::class);
    }
}
