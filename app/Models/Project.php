<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_name',
        'client_name',
        'phone',
        'address',
        'lat',
        'long',
        'discount',
        'outlet_id',
        'status',
    ];

    public function project_detail()
    {
        return $this->hasMany('App\Models\ProjectDetail');
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id');
    }
    
    public function payment()
    {
        return $this->hasOne('App\Models\Payment');
    }
    
    public function material()
    {
        return $this->hasOne('App\Models\Material');
    }
}
