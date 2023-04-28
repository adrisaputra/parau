<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;
    protected $fillable = [
        'team_id',
        'worker_name',
        'salary',
    ];

    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }

    public function worker_payment()
    {
        return $this->hasOne('App\Models\WorkerPayment');
    }
}
