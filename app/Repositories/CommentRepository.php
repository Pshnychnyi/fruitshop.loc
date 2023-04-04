<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository extends Repository
{
    public function __construct(Comment $comment) {
        $this->model = $comment;
    }


    public function updateComment($request, $comment) {
        $data = $request->except('_token', '_method');
        if(empty($data)) {
            return ['errors' => 'Нет данных'];
        }
        if($comment->update($data)) {
            return ['success' => 'Изменения сохранены'];
        }
    }

    public function deleteComment($comment) {
        return $comment->delete() ? ['success'=> 'Запись удалена'] : ['errors'=> 'Ошибка удаления'];

    }
}
