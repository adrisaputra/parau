<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseTransaction extends Model
{
    use HasFactory;

    protected $table = "purchase_transactions";
    protected $fillable = ['transaction_number', 'status', 'user_id', 'supplier_id', 'pay_cost', 'total_price', 'transaction_date'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }

    public function purchase_detail()
    {
        return $this->hasMany(PurchaseDetail::class, 'purchase_transaction_id');
    }
}
