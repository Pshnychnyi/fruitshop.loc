<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Models\Slider;


class SliderRepository extends Repository
{
    protected $menu;

    public function __construct(Slider $slider, Menu $menu) {
        $this->model = $slider;
        $this->menu = $menu;
    }

    public function createSlider($request) {
        $data = $request->except('_token');
        if(empty($data)) {
            return ['errors' => 'Нет данных'];
        }

        if(isset($data['first_link_path'])) {
            $data['first_link_path'] = $this->menu->find($data['first_link_path'])->path;
        }
        if(isset($data['second_link_path'])) {
            $data['second_link_path'] = $this->menu->find($data['second_link_path'])->path;
        }



        if($this->model->create($data)) {
            return ['success' => 'Запись добавлена'];
        }
    }

    public function updateSlider($request, $slider) {
        $data = $request->except('_token', '_method');
        if(empty($data)) {
            return ['errors' => 'Нет данных'];
        }
        if($slider->update($data)) {
            return ['success' => 'Изменения сохранены'];
        }
    }

    public function deleteSlider($slider) {

        return ($slider->delete()) ? ['success'=> 'Запись удалена'] : ['errors'=> 'Ошибка удаления'];

    }
}
