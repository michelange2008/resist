<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Molecule extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function anthelms()
    {
        return $this->belongsToMany(Anthelm::class);
    }
}
