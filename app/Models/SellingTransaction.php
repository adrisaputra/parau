<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sellingTransaction extends Model
{
    use HasFactory;

    protected $table = "selling_transactions";
    protected $fillable = ['transaction_number', 'status', 'user_id', 'member_id', 'pay_cost', 'discount', 'total_price', 'transaction_date','type'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function selling_detail()
    {
        return $this->hasMany(SellingDetail::class, 'selling_transaction_id');
    }
}
