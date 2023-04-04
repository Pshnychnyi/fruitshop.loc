<?php

namespace App\Repositories;

use App\Models\Tag;

class TagRepository extends Repository
{
    public function __construct(Tag $tag) {
        $this->model = $tag;
    }

    public function createTag($request) {
        $data = $request->except('_token');
        if(empty($data)) {
            return ['errors' => 'Нет данных'];
        }
        if($this->model->create($data)) {
            return ['success' => 'Запись добавлена'];
        }
    }

    public function updateTag($request, $tag) {
        $data = $request->except('_token', '_method');
        if(empty($data)) {
            return ['errors' => 'Нет данных'];
        }
        if($tag->update($data)) {
            return ['success' => 'Изменения сохранены'];
        }
    }

    public function deleteTag($tag) {

        if($tag){
            $tag->news()->detach();

            return ($tag->delete()) ? ['success'=> 'Запись удалена'] : ['errors'=> 'Ошибка удаления'];
        }



    }
}
