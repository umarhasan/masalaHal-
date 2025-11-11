<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadGenrate extends Model
{
use HasFactory;
    protected $guarded = [];

    public function users()
    {
        return $this->hasOne(User::class,'id','assign_company_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }
}
