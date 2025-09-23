<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'quantity',
        'price',
        'user_id',
        'vendor_id',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
