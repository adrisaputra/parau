<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'team_id',
        'work_name',
        'description',
        'service_value',
        'volume',
        'image',
        'work_start',
        'work_end',
        'estimation',
        'status',
    ];

    public function project(){
    	return $this->belongsTo('App\Models\Project');
    }
    
    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }


    
}
