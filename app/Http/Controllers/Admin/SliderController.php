<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SliderRequest;
use App\Repositories\MenuRepository;
use App\Repositories\SliderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SliderController extends MainController
{
    /**
     * @var SliderRepository
     */
    public $slider_rep;
    public $menu_rep;

    public function __construct(SliderRepository $slider_rep, MenuRepository $menu_rep)
    {
        $this->template = 'admin.slider.index';
        $this->slider_rep = $slider_rep;
        $this->menu_rep = $menu_rep;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('VIEW_ADMIN')){
            return abort(404);
        }

        $this->title = 'Слайды';
        $sliders = $this->getSliders();

        $this->content = view('admin.slider.content')->with('sliders', $sliders);

        return $this->renderOutput();
    }

    public function getSliders()
    {
        return $this->slider_rep->get(['id', 'slug', 'title', 'description'], false, true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('CREATE_ITEMS')){
            return abort(404);
        }
        $this->title = 'Создание слайда';

        $links = $this->menu_rep->get(['id', 'title']);

        $this->content = view('admin.slider.create', compact('links'));

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        if(Gate::denies('CREATE_ITEMS')){
            return abort(404);
        }

        $result = $this->slider_rep->createSlider($request);
        if(is_array($result) && !empty($result['errors'])) {
            return redirect()->back()->with($result);
        }

        return redirect()->route('slider.index')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('UPDATE_ITEMS')){
            return abort(404);
        }
        $this->title = 'Редактирование слайда';

        $slider = $this->getSlider($id);
        $links = $this->menu_rep->get(['id', 'title', 'path']);
        $this->content = view('admin.slider.edit', compact('links', 'slider'));
        return $this->renderOutput();
    }

    public function getSlider($id) {

        return $this->slider_rep->one($id) ?: false;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Gate::denies('UPDATE_ITEMS')){
            return abort(404);
        }

        $slider = $this->getSlider($id);

        $result = $this->slider_rep->updateSlider($request, $slider);

        return (is_array($result) && !empty($result['errors'])) ? redirect()->back()->with($result) : redirect()->route('slider.index')->with($result);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('DELETE_ITEMS')){
            return abort(404);
        }

        $slider = $this->getSlider($id);

        $result = $this->slider_rep->deleteSlider($slider);
        return (is_array($result) && !empty($result['errors'])) ? redirect()->back()->with($result) : redirect()->route('slider.index')->with($result);
    }
}
