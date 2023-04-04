<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Gate;

class CategoryController extends MainController
{
    public $cat_rep;

    public function __construct(CategoryRepository $cat_rep) {
        $this->template = 'admin.category.index';
        $this->cat_rep = $cat_rep;
    }

    public function index()
    {

        if(Gate::denies('VIEW_ADMIN')){
            return abort(404);
        }

        $this->title = 'Категории';

        $categories = $this->getCategories();

        $this->content = view('admin.category.content')->with('categories', $categories);

        return $this->renderOutput();
    }

    public function getCategories() {
        return $this->cat_rep->get(['id', 'title'], false, true);
    }


    public function create()
    {
        if(Gate::denies('CREATE_ITEMS')){
            return abort(404);
        }

        $this->title = 'Создание категории';
        $this->content = view('admin.category.create');
        return $this->renderOutput();
    }


    public function store(CategoryRequest $request)
    {
        if(Gate::denies('CREATE_ITEMS')){
            return abort(404);
        }

        $result = $this->cat_rep->createCategory($request);

        if(is_array($result) && !empty($result['errors'])) {
            return redirect()->back()->with($result);
        }

        return redirect()->route('category.index')->with($result);

    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        if(Gate::denies('UPDATE_ITEMS')){
            return abort(404);
        }
        $this->title = 'Редактирование категории';

        $category = $this->getCategory($id);

        $this->content = view('admin.category.edit')->with('category', $category);
        return $this->renderOutput();
    }

    public function getCategory($id) {
        $category = $this->cat_rep->one($id);

        if(!$category) {
            return false;
        }
        return $category;
    }

    public function update(CategoryRequest $request, $id)
    {
        if(Gate::denies('UPDATE_ITEMS')){
            return abort(404);
        }

        $category = $this->getCategory($id);

        $result = $this->cat_rep->updateCategory($request, $category);

        if (is_array($result) && !empty($result['errors'])){

            return redirect()->back()->with($result);
        }

        return redirect()->route('category.index')->with($result);

    }

    public function destroy($id)
    {
        if(Gate::denies('DELETE_ITEMS')){
            return abort(404);
        }

        $category = $this->getCategory($id);
        $result = $this->cat_rep->deleteCategory($category);

        if (is_array($result) && !empty($result['errors'])) {
            return redirect()->back()->with($result);
        }

        return redirect()->route('category.index')->with($result);
    }
}
