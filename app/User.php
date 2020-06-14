<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    static $parties = ["NRM", "FDC", "INDEPENDENT", "PEOPLE POWER", "DP"];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_candidate', 'party'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getPartyAttribute($value)
    {
        return strtoupper($value);
    }

    public static function validParties() 
    {
        $func = function ($name) {
            return strtolower($name);
        };

        return array_map($func, User::$parties);

    }
}
