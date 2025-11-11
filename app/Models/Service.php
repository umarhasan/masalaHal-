<?php
 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;

 class Service extends Model
 {
     protected $fillable = ['lead_service_id', 'name', 'description', 'price','credit'];

     public function leadService()
     {
         return $this->belongsTo(LeadService::class,'lead_service_id','id');
     }
 }
