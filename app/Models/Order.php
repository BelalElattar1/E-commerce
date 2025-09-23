<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'totalPrice',
        'user_id'
    ];

    public function orderVendors() {
        return $this->hasMany(OrderVendor::class);
    }
}
