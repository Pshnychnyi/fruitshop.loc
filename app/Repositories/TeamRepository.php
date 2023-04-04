<?php

namespace App\Repositories;

use App\Models\Team;
use Illuminate\Support\Facades\Storage;


class TeamRepository extends Repository
{
    public function __construct(Team $team) {
        $this->model = $team;
    }

    public function createTeam($request) {
        $data = $request->except('_token');

        if(empty($data)) {
            return ['errors' => 'Нет данных'];
        }

        $data['img'] = $this->resizeImage($request->file('img'), false, 350, 400);


        if($this->model->create($data)) {
            return ['success' => 'Запись добавлена'];
        }
    }

    public function updateTeam($request, $team) {
        $data = $request->except('_token');

        if(empty($data)) {
            return ['errors' => 'Нет данных'];
        }
        if($this->resizeImage($request->file('img'), $team->img, 350, 400)){
            $data['img'] = $this->resizeImage($request->file('img'), $team->img, 350, 400);
        }

        if($team->update($data)) {
            return ['success' => 'Изменения сохранены'];
        }
    }

    public function deleteTeam($team) {
        if($team) {
            if(Storage::disk('public')->exists($team->img) && $team->img !== 'img/No_Image_Available.jpg') {
                Storage::delete($team->img);
            }
            return ($team->delete()) ? ['success'=> 'Запись удалена'] : ['errors'=> 'Ошибка удаления'];
        }


    }
}
