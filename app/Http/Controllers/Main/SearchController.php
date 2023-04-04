<?php

namespace App\Http\Controllers\Main;


use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\NewsRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;


class SearchController extends SiteController
{
    public $prod_rep;
    public $cat_rep;
    public $news_rep;

    public function __construct(ProductRepository $prod_rep, CategoryRepository $cat_rep, NewsRepository $news_rep) {
        parent::__construct();
        $this->template = 'main.search.index';
        $this->prod_rep = $prod_rep;
        $this->cat_rep = $cat_rep;
        $this->news_rep = $news_rep;


    }

    public function index(Request $request) {

        $this->slug = 'Мы продаем свежие фрукты';
        $this->desc = 'Мы продаем свежие фрукты';
        $this->keywords = 'Мы продаем свежие фрукты';

        $request->validate([
            's' => 'required'
        ]);

        $s = $request->s;
        $this->title = 'Результаты поиска по запросу: ' .  $s;

        $products = $this->getProducts($s);
        $news = $this->getNews($s);
        $cats = $this->getCats();

        if($news->count() || $products->count()) {
            $this->content = view('main.search.content', compact('products','cats', 'news'));
        }else {
            $this->content = view('errors.notfound');
        }

        return $this->renderOutput();
    }

    public function getProducts($s) {
        return $this->prod_rep->get(['id', 'alias', 'title', 'price', 'img', 'per'],false, true, ["title", "LIKE", "%$s%"]);
    }
    public function getNews($s) {
        return $this->news_rep->get(['id', 'alias', 'title', 'content', 'img', 'created_at', 'user_id', 'preview_image', 'preview_text'],false, true, ["title", "LIKE", "%$s%"]);
    }
    public function getCats() {
        return $this->cat_rep->get(['id', 'title']);
    }



}
