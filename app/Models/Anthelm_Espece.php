<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Anthelm_Espece extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];
    protected $table = "anthelm_espece";

    public function voie(): BelongsTo
    {
        return $this->belongsTo(Voie::class);
    }

    public function unite(): BelongsTo
    {
        return $this->belongsTo(Unite::class);
    }

}
