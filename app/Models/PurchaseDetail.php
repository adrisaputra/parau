<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;
    protected $fillable = ['purchase_transaction_id', 'product_id', 'amount', 'price'];
    //
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function purchaseTransaction()
    {
        return $this->belongsTo(PurchaseTransaction::class, 'purchase_transaction_id', 'id');
    }
}
