<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderVendor extends Model
{
    protected $fillable = [
        'totalPrice',
        'status',
        'vendor_id',
        'order_id',
        'user_id',
        'order_id'
    ];
}
