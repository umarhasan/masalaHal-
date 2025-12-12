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


    public function seller()
    {
        return $this->hasOne(Seller::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // public function transactions()
    // {
    //     return $this->hasMany(Transaction::class);
    // }

    // ========== Accessors / Helpers ==========
    public function getFullNameAttribute()
    {
        return $this->userInformation ? $this->userInformation->first_name.' '.$this->userInformation->last_name : $this->name;
    }

    public function getAvatarAttribute()
    {
        return $this->images[0] ?? asset('admin/assets/img/avatars/default.png');
    }

    public function isSeller(): bool
    {
        return $this->seller()->exists();
    }
}
