<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Interfaces\Wallet;


class User extends Authenticatable implements MustVerifyEmail, Wallet
{
    use HasApiTokens,HasFactory,Notifiable,HasRoles,HasWallet;

    
    protected $guarded = [];

    
    protected $casts = [
        'hobbies' => 'array',
        'social_links' => 'array',
        'images' => 'array',
        'email_verified_at' => 'datetime',
    ];

    
    public function scopeWithRole($query, $roleName)
    {
        return $query->whereHas('roles', function ($query) use ($roleName) {
            $query->where('name', $roleName);
        });
    }
    
    public function userInformation()
    {
        return $this->hasOne(UserInformation::class);
    }
}
