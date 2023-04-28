<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'outlet_id',
        'team_name',
        'description',
    ];

    public function outlet()
    {
        return $this->belongsTo('App\Models\Outlet');
    }

    public function worker()
    {
        return $this->hasOne('App\Models\Worker');
    }
    
    public function project_detail()
    {
        return $this->hasOne('App\Models\ProjectDetail');
    }

}
