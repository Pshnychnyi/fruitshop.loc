<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends Repository
{
    public function __construct(Category $category) {
        $this->model = $category;
    }

    public function createCategory($request) {
        $data = $request->except('_token');
        if(empty($data)) {
            return ['errors' => 'Нет данных'];
        }
        if($this->model->create($data)) {
            return ['success' => 'Запись добавлена'];
        }
    }

    public function updateCategory($request, $category) {
        $data = $request->except('_token', '_method');
        if(empty($data)) {
            return ['errors' => 'Нет данных'];
        }
        if($category->update($data)) {
            return ['success' => 'Изменения сохранены'];
        }
    }

    public function deleteCategory($category) {
        if($category->products) {
            return ['error'=> 'Ошибка удаления! В данной категории есть вложенные товары'];
        }

        return $category->delete() ? ['success'=> 'Запись удалена'] : ['errors'=> 'Ошибка удаления'];

    }
}
