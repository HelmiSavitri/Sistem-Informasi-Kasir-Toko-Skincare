<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    // Nama tabel (opsional jika sama dengan 'brands')
    protected $table = 'brands';

    // Kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'name',
        'description',
    ];

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'brand_supplier');
    }
}
