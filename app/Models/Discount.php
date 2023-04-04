<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discounts';

    protected $fillable = ['title', 'percent', 'deadline'];

    public function products() {
        return $this->hasMany(Product::class, 'discount_id', 'id');
    }
}
