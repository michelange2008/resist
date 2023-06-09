<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anthelm extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function molecules()
    {
        return $this->belongsToMany(Molecule::class);
    }
}
