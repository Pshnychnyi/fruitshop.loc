<?php

namespace App\Repositories;

use App\Models\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsRepository extends Repository
{
    public function __construct(News $news) {
        $this->model = $news;
    }

    public function createNews($request) {

        $data = $request->except('_token');

        if(empty($data)) {
            return ['errors' => 'Нет данных'];
        }
        if($data['preview_image']) {
            $data['preview_image'] = $this->resizeImage($request->file('preview_image'),false, 350, 216);
        }
        $data['img'] = $this->resizeImage($request->file('img'), false, 730, 450);
        $data['user_id'] = Auth::user()->id;
        $tags = $data['tags'] ?? [];
        unset($data['tags']);

        $news = $this->model->create($data);
        if($news && $tags) {
            $news->syncTags($tags);
            return ['success' => 'Запись добавлена'];
        }

    }

    public function updateNews($request, $news) {
        $data = $request->except('_token', '_method');
        if(empty($data)) {
            return ['errors' => 'Нет данных'];
        }

        if($this->resizeImage($request->file('img'), $news->img, 730, 450)){
            $data['img'] = $this->resizeImage($request->file('img'), $news->img, 730, 450);
        }
        if($this->resizeImage($request->file('preview_image'), $news->preview_image, 350, 216)){
            $data['preview_image'] = $this->resizeImage($request->file('preview_image'), $news->preview_image, 350, 216);
        }
        $data['user_id'] = Auth::user()->id;
        $tags = $data['tags'] ?? [];
        unset($data['tags']);

        if($news->update($data)) {
            $news->syncTags($tags);
            return ['success' => 'Изменения сохранены'];
        }
    }

    public function deleteNews($news) {

        if($news) {
            $news->tags()->detach();
            if(Storage::disk('public')->exists($news->img) && $news->img !== 'img/No_Image_Available.jpg') {
                Storage::delete($news->img);
            }
            return $news->delete() ? ['success'=> 'Запись удалена'] : ['errors'=> 'Ошибка удаления'];
        }


    }
}
