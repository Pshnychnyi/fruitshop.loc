<?php

namespace App\Http\Controllers\Main;


use Illuminate\Support\Carbon;
use App\Repositories\NewsRepository;
use Illuminate\Support\Facades\DB;

class NewsController extends SiteController
{
    public $news_rep;

    public function __construct(NewsRepository $news_rep) {
        parent::__construct();
        $this->template = 'main.news.index';
        $this->news_rep = $news_rep;

    }

    public function index() {
        $this->title = 'Новости';
        $this->slug = 'Органическая  информация';
        $this->desc = 'Органическая  информация';
        $this->keywords = 'Органическая  информация';

        $news = $this->getNews();
        $this->content = view('main.news.content', compact('news'));
        return $this->renderOutput();
    }

    public function getNews() {
        return $this->news_rep->get(['id', 'alias', 'title', 'content', 'img', 'created_at', 'user_id', 'preview_image', 'preview_text'], false,true);
    }

    public function show($id) {
        $oneNews = $this->news_rep->one($id);

        $this->title = $oneNews->title;
        $this->slug = 'Органическая  информация';
        $this->desc = 'Органическая  информация';
        $this->keywords = 'Органическая  информация';



        $recentPosts = $this->news_rep->get(['id', 'title'], 5, false, false, false, 'DESC');
        $archives = DB::table('news')->orderBy('created_at')->select('id', 'created_at')->get()->groupBy(function($events) {
            return Carbon::parse($events->created_at)->format('F Y'); // А это то-же поле по нему мы и будем группировать
        });

        $comments = $oneNews->comments->groupBy('parent_id');

        $this->content = view('main.news.show', compact('oneNews', 'recentPosts', 'archives', 'comments'));
        return $this->renderOutput();
    }


}
