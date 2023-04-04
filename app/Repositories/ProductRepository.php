<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductRepository extends Repository
{
    public function __construct(Product $product) {
        $this->model = $product;
    }

    public function createProduct($request) {
        $data = $request->except('_token');


        if(empty($data)) {
            return ['errors' => 'Нет данных'];
        }

        $data['img'] = $this->resizeImage($request->file('img'), false, 350, 400);

        $categories = $data['cats'];
        $relatedProducts = $data['relates'] ?? '';
        unset($data['cats']);
        unset($data['relates']);

       $product = $this->model->create($data);
        if($product) {
            if($categories) {
                $product->syncCats($categories);
            }
            if($relatedProducts) {
                $product->syncRelates($relatedProducts);
            }

            return ['success' => 'Запись добавлена'];
        }
    }

    public function updateProduct($request, $product) {
        $data = $request->except('_token', '_method');

        if(empty($data)) {
            return ['errors' => 'Нет данных'];
        }


        if($this->resizeImage($request->input('img'), $product->img, 350, 400)){
            $data['img'] = $this->resizeImage($request->file('img'), $product->img, 350, 400);
        }


        $categories = $data['cats'] ?? [];
        $relatedProducts = $data['relates'] ?? [];
        unset($data['cats']);
        unset($data['relates']);


        if($product->update($data)) {

            $product->syncCats($categories);

            $product->syncRelates($relatedProducts);

            return ['success' => 'Изменения сохранены'];
        }
    }

    public function deleteProduct($product) {
        if($product) {
            $product->categories()->detach();
            $product->relatedProducts()->detach();
            if(Storage::disk('public')->exists($product->img) && $product->img !== 'img/No_Image_Available.jpg') {
                Storage::delete($product->img);
            }
            return ($product->delete()) ? ['success'=> 'Запись удалена'] : ['errors'=> 'Ошибка удаления'];
        }
    }



}
