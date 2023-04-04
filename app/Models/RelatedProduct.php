<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedProduct extends Model
{
    use HasFactory;

    protected $table = 'products';

    public function products(){
        return $this->belongsToMany(Product::class, 'related_product', 'related_id', 'product_id');
    }
}
