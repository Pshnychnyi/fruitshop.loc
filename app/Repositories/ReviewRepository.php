<?php

namespace App\Repositories;

use App\Models\Review;
use Illuminate\Support\Facades\Storage;

class ReviewRepository extends Repository
{
    public function __construct(Review $review) {
        $this->model = $review;
    }

    public function createReview($request) {
        $data = $request->except('_token');

        if(empty($data)) {
            return ['errors' => 'Нет данных'];
        }

        $data['img'] = $this->resizeImage($request->file('img'), false, 100, 100);


        if($this->model->create($data)) {
            return ['success' => 'Запись добавлена'];
        }
    }

    public function updateReview($request, $review) {
        $data = $request->except('_token');

        if(empty($data)) {
            return ['errors' => 'Нет данных'];
        }
        if($this->resizeImage($request->file('img'), $review->img, 100, 100)){
            $data['img'] = $this->resizeImage($request->file('img'), $review->img, 100, 100);
        }

        if($review->update($data)) {
            return ['success' => 'Изменения сохранены'];
        }
    }

    public function deleteReview($review) {
        if($review) {
            if(Storage::disk('public')->exists($review->img) && $review->img !== 'img/No_Image_Available.jpg') {
                Storage::delete($review->img);
            }
            return ($review->delete()) ? ['success'=> 'Запись удалена'] : ['errors'=> 'Ошибка удаления'];
        }


    }
}
