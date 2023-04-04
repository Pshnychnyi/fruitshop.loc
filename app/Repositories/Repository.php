<?php

namespace App\Repositories;



use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Repository
{
    protected $model = false;
    protected $request = false;

    public function get($select = '*', $take = false, $pagination = false, $where = false, $random = false, $order = 'ASC') {
        $builder = $this->model->select($select);

        if($take) {
            if ($builder->get()->count() > $random) {
                $builder->take($take);
            }
        }

        if ($where) {
            count($where) === 3 ? $builder->where($where[0], $where[1], $where[2]) : $builder->where($where[0], $where[1]);
        }

        if($random) {
            if ($builder->get()->count() > $random) {
                return $builder->get()->random($random);
            }
        }

        if($pagination) {
            return $builder->paginate(Config::get('settings.pagination'));
        }

        return $builder->orderBy('created_at', $order)->get();
    }

    public function one($id, $attr = false) {
        $result = $this->model->where('id', $id)->first();
         return $result;
    }

    public function resizeImage($file, $filePath = false, $width = 300, $height = 400) {

        if ($file) {

            if($filePath && Storage::disk('public')->exists($filePath) && $filePath !== 'img/No_Image_Available.jpg') {
                Storage::disk('public')->delete($filePath);
            }
            $dataPath = $file->store('img/' . date('d-m-Y'));
            $extension = $file->extension();
            $imageData = Storage::disk('public')->get($dataPath);

            $imageStream = Image::make($imageData)->resize($width, $height)->stream($extension, 100);;

            Storage::disk('public')->put($dataPath, $imageStream);

            return $dataPath;

        }elseif (!$filePath){
            return 'img/No_Image_Available.jpg';

        }else {
            return false;
        }
    }


}
