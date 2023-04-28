<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'worker_id',
        'desc',
        'service_payment',
        'down_payment',
        'date'
    ];

    public function worker()
    {
        return $this->belongsTo('App\Models\Worker');
    }
}
