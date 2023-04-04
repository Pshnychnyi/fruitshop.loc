<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';


    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }


    public function getOrderDetail() {
        $order = [];
        foreach ($this->products()->get()->toArray() as $key => $product) {
            $order[$product['title']] = $product['price'] * $product['pivot']['quantity'];
        }
        return $order;
    }

    public function getCountItems() {
        $count = 0;
        foreach ($this->products()->get() as $product) {
            $count+= $product->pivot->quantity;
        }
        return $count;
    }

    public function getTotalPrice() {
        $total = 0;
        if($this->getOrderDetail()) {
            foreach ($this->getOrderDetail() as $price) {
                $total += $price;
            }

            return $total;
        }
    }


    public function increase($id, $count = 1) {

        if ($this->products->contains($id)) {
            // если такой товар есть в корзине — изменяем кол-во
            $pivotRow = $this->products()->where('product_id', $id)->first()->pivot;
            $quantity = $pivotRow->quantity + $count;
            $pivotRow->update(['quantity' => $quantity]);
        } else {
            // если такого товара нет в корзине — добавляем его
            $this->products()->attach($id, ['quantity' => $count]);
        }
    }


    public function change($product_id, $count = 0) {
        if ($count == 0) {
            return;
        }
        // если товар есть в корзине — изменяем кол-во
        if ($this->products->contains($product_id)) {

            $pivotRow = $this->products()->where('product_id', $product_id)->first()->pivot;

            $quantity = $pivotRow->quantity > $count ? ($pivotRow->quantity - ($pivotRow->quantity - $count)) : $pivotRow->quantity + ($count - $pivotRow->quantity);
            if ($quantity > 0) {
                // обновляем кол-во товара $product_id в корзине
                $pivotRow->update(['quantity' => $quantity]);
                // обновляем поле `updated_at` таблицы `carts`
                $this->touch();
                return $quantity;
            } else {
                // кол-во равно нулю — удаляем товар из корзины
                $pivotRow->delete();
            }
        }
    }

    public function saveOrder($data) {
        $user_id = auth()->check() ? auth()->user()->id : null;

        $order = Order::create(
            $data + ['amount' => $this->getTotalPrice(), 'user_id' => $user_id]
        );

        foreach ($this->products as $product) {
            $order->orderProducts()->create([
                'product_id' => $product->id,
                'name' => $product->title,
                'price' => $product->price,
                'quantity' => $product->pivot->quantity,
                'cost' => $product->price * $product->pivot->quantity,
            ]);
        }
        $this->delete();
    }


}
