<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sellingDetail extends Model
{
    protected $fillable = ['selling_transaction_id', 'product_id', 'amount', 'price'];
    //
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function sellingTransaction()
    {
        return $this->belongsTo(SellingTransaction::class, 'selling_transaction_id', 'id');
    }
}
