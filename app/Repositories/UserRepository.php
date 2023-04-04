<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository
{
    public function __construct(User $user) {
        $this->model = $user;
    }

    public function createUser($request) {
        $data = $request->except('_token');

        if(empty($data)) {
            return ['errors' => 'Нет данных'];
        }


        if($this->model->create($data)) {
            return ['success' => 'Запись добавлена'];
        }
    }

    public function updateUser($request, $user) {
        $data = $request->except('_token');

        if(empty($data)) {
            return ['errors' => 'Нет данных'];
        }

        if($user->update($data)) {
            return ['success' => 'Изменения сохранены'];
        }
    }

    public function deleteUser($user) {
        if($user) {
            $user->roles()->detach();
            return ($user->delete()) ? ['success'=> 'Запись удалена'] : ['errors'=> 'Ошибка удаления'];
        }


    }
}
