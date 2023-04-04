<?php

namespace App\Repositories;

use App\Models\Discount;
use App\Models\Product;

class DiscountRepository extends Repository
{
    public function __construct(Discount $discount) {
        $this->model = $discount;
    }

    public function createDiscount($request) {
        $data = $request->except('_token');
        if(empty($data)) {
            return ['errors' => 'Нет данных'];
        }


        $products = $data['products'];

        unset($data['products']);
        $discount = $this->model->create($data);
        if($discount) {

            foreach ($products as $product_id) {
                Product::find($product_id)->discount()->associate($discount)->save();
            }

            return ['success' => 'Запись добавлена'];
        }
    }

    public function updateDiscount($request, $discount) {
        $data = $request->except('_token', '_method');
        if(empty($data)) {
            return ['errors' => 'Нет данных'];
        }

        $products = $data['products'];
        unset($data['products']);
        foreach ($products as $product_id) {
            Product::find($product_id)->discount()->associate($discount)->save();
        }
        if($discount->update($data)) {
            return ['success' => 'Изменения сохранены'];
        }
    }

    public function deleteDiscount($discount) {
        if($discount->products) {
            foreach ($discount->products as $product) {
                $product->discount()->dissociate()->save();
            }

        }

        return $discount->delete() ? ['success'=> 'Запись удалена'] : ['errors'=> 'Ошибка удаления'];

    }
}
