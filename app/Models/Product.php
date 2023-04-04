<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title', 'description', 'price', 'img', 'per', 'discount_id'];

    protected $table = 'products';

    public function sluggable(): array
    {
        return [
            'alias' => [
                'source' => 'title'
            ]
        ];
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    public function discount() {
        return $this->belongsTo(Discount::class, 'discount_id', 'id');
    }

    public function relatedProducts(){

        return $this->belongsToMany(RelatedProduct::class, 'related_product', 'product_id', 'related_id');
    }

    public function syncCats($categories = []) {

        if(!empty($categories)) {
            $this->categories()->sync($categories);
        }else {
            $this->categories()->detach();
        }

        return true;
    }

    public function syncRelates($relatedProducts = []) {
        if(!empty($relatedProducts)) {
            $this->relatedProducts()->sync($relatedProducts);
        }else {
            $this->relatedProducts()->detach();
        }

        return true;
    }

    public function baskets() {
        return $this->belongsToMany(Cart::class)->withPivot('quantity');
    }

    /*public function scopeLike($query, $s) {
        return $query->where('title', 'LIKE', "%$s%");
    }*/

}
