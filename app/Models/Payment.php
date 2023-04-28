<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'desc',
        'down_payment',
        'date'
    ];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }
}
