<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    function isAdmin() : bool 
    {
        if ($this->role->nom == 'admin' ) {
            return true;
        } else {
            return false;
        }
    }

    function isVeto() : bool
    {
        if($this->role->nom == 'veto') {
            return true;
        } else {
            return false;
        }
    }

    function isEleveur() : bool
    {
        if($this->role->nom == 'eleveur') {
            return true;
        } else {
            return false;
        }
    }

    function role() : BelongsTo {
        return $this->belongsTo(Role::class);
    }

    function ferme() : HasOne {
        return $this->hasOne(Ferme::class);
    }

    function fermes() : HasMany {
        return $this->hasMany(Ferme::class);
    }
}
