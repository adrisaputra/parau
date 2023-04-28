<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // protected $table = 'pegawai_tbl';
    protected $fillable = [
        'code',
        'product_name',
        'unit',
        'outlet_id',
        'image',
        'purchase_price',
        'selling_price',
        'description',
        'status',
    ];

    public function product_category()
    {
        return $this->hasMany('App\Models\ProductCategory');
    }

    public function purchase_detail()
    {
        return $this->hasMany(PurchaseDetail::class, 'product_id', 'id');
    }

    public function inventory()
    {
        return $this->hasOne('App\Models\Inventory');
    }

    public function material()
    {
        return $this->hasOne('App\Models\Material');
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id');
    }
    
}
