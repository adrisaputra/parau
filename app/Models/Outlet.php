<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $fillable = [
        'outlet_name',
        'phone',
        'address',
        'lat',
        'long',
        'description',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public function product()
    {
        return $this->hasOne('App\Models\Product');
    }

    public function project()
    {
        return $this->hasOne('App\Models\Project');
    }

    public function team()
    {
        return $this->hasOne('App\Models\Outlet');
    }
}
