<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'comment',
        'amount',
    ];

    public function orderProducts() {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }
}
