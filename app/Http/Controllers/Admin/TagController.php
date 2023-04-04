<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagRequest;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TagController extends MainController
{
    /**
     * @var TagRepository
     */
    public $tag_rep;

    public function __construct(TagRepository $tag_rep)
    {
        $this->template = 'admin.tag.index';
        $this->tag_rep = $tag_rep;
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

        $this->title = 'Теги';
        $tags = $this->getTags();

        $this->content = view('admin.tag.content')->with('tags', $tags);

        return $this->renderOutput();
    }

    public function getTags()
    {
        return $this->tag_rep->get(['id', 'title'], false, true);

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

        $this->title = 'Создание тега';

        $this->content = view('admin.tag.create');

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        if(Gate::denies('CREATE_ITEMS')){
            return abort(404);
        }

        $result = $this->tag_rep->createTag($request);
        if(is_array($result) && !empty($result['errors'])) {
            return redirect()->back()->with($result);
        }

        return redirect()->route('tag.index')->with($result);
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
        $this->title = 'Редактирование тега';

        $tag = $this->getTag($id);

        $this->content = view('admin.tag.edit')->with('tag', $tag);
        return $this->renderOutput();
    }

    public function getTag($id) {

        return $this->tag_rep->one($id) ?: false;
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

        $tag = $this->getTag($id);

        $result = $this->tag_rep->updateTag($request, $tag);

        return (is_array($result) && !empty($result['errors'])) ? redirect()->back()->with($result) : redirect()->route('tag.index')->with($result);

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

        $tag = $this->getTag($id);

        $result = $this->tag_rep->deleteTag($tag);
        return (is_array($result) && !empty($result['errors'])) ? redirect()->back()->with($result) : redirect()->route('tag.index')->with($result);
    }
}
