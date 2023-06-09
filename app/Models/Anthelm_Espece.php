<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anthelm_Espece extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];
    protected $table = "anthelm_espece";

    public function voie()
    {
        return $this->belongsTo(Voie::class);
    }

    public function unite()
    {
        return $this->belongsTo(Unite::class);
    }

}
