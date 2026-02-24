<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_code',
        'total_price',
        'total',
        'paid_amount',
        'change_amount'
    ];

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function rating()
    {
        // Menghubungkan transaksi ke rating berdasarkan transaction_id
        return $this->hasOne(Rating::class, 'transaction_id');
    }
}
