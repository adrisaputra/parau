<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'selling_detail_id',
        'selling_transaction_id',
        'project_id',
        'purchase_place',
        'product_id',
        'product_name',
        'outlet_name',
        'price',
        'unit',
        'amount',
        'date',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }
    
}
