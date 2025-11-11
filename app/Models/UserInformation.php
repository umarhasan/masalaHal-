<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'hobbies' => 'array',
        'social_links' => 'array',
        'images' => 'array', // Ensure hobbies are stored as an array
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
