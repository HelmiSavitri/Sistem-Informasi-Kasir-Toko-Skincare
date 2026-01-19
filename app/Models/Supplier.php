<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = [
        'name',
        'phone',
        'address',
        'brand_ids',
    ];

    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'brand_supplier');
    }
}
