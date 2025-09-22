<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'quantity',
        'price',
        'order_vendor_id',
        'product_id'
    ];
}
