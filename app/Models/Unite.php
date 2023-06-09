<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unite extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function anthelm_especes()
    {
        return $this->hasMany(Anthelm_Espece::class);
    }
}
