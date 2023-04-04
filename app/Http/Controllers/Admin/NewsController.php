<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NewsRequest;
use App\Models\Tag;
use App\Repositories\NewsRepository;
use Illuminate\Support\Facades\Gate;

class NewsController extends MainController
{
    public $news_rep;
    public $tag_rep;

    public function __construct(NewsRepository $news_rep, Tag $tag_rep) {
        $this->template = 'admin.news.index';
        $this->news_rep = $news_rep;
        $this->tag_rep = $tag_rep;
    }

    public function index()
    {
        if(Gate::denies('VIEW_ADMIN')){
            return abort(404);
        }
        $this->title = 'Новости';

        $allNews = $this->getAllNews();

        $this->content = view('admin.news.content')->with('allNews', $allNews);

        return $this->renderOutput();
    }

    public function getAllNews() {
        return $this->news_rep->get(['id', 'title', 'content', 'user_id'], false, true);
    }


    public function create()
    {
        if(Gate::denies('CREATE_ITEMS')){
            return abort(404);
        }

        $this->title = 'Создание новости';
        $tags = $this->getTags();
        $this->content = view('admin.news.create', compact('tags'));
        return $this->renderOutput();
    }

    public function getTags() {
        return $this->tag_rep->get(['id', 'title']);
    }



    public function store(NewsRequest $request)
    {
        if(Gate::denies('CREATE_ITEMS')){
            return abort(404);
        }

        $result = $this->news_rep->createNews($request);

        if(is_array($result) && !empty($result['errors'])) {
            return redirect()->back()->with($result);
        }

        return redirect()->route('news.index')->with($result);

    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        if(Gate::denies('UPDATE_ITEMS')){
            return abort(404);
        }
        $this->title = 'Редактирование новости';

        $news = $this->getNews($id);
        $tags = $this->getTags();
        $this->content = view('admin.news.edit')->with(['news' => $news, 'tags' => $tags]);
        return $this->renderOutput();
    }

    public function getNews($id) {
        $news = $this->news_rep->one($id);

        if(!$news) {
            return false;
        }
        return $news;
    }

    public function update(NewsRequest $request, $id)
    {
        if(Gate::denies('UPDATE_ITEMS')){
            return abort(404);
        }

        $news = $this->getNews($id);

        $result = $this->news_rep->updateNews($request, $news);

        if (is_array($result) && !empty($result['errors'])){

            return redirect()->back()->with($result);
        }

        return redirect()->route('news.index')->with($result);

    }

    public function destroy($id)
    {
        if(Gate::denies('DELETE_ITEMS')){
            return abort(404);
        }

        $news = $this->getNews($id);
        $result = $this->news_rep->deleteNews($news);

        if (is_array($result) && !empty($result['errors'])) {
            return redirect()->back()->with($result);
        }

        return redirect()->route('news.index')->with($result);
    }
}
