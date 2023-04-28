<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'in_stock',
        'min_stock',
        'full_stock',
    ];
    
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
