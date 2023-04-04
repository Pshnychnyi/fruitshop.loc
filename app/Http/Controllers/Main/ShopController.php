<?php

namespace App\Http\Controllers\Main;



use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;


class ShopController extends SiteController
{
    public $prod_rep;
    public $cat_rep;


    public function __construct(ProductRepository $prod_rep, CategoryRepository $cat_rep) {
        parent::__construct();
        $this->template = 'main.shop.index';
        $this->prod_rep = $prod_rep;
        $this->cat_rep = $cat_rep;


    }

    public function index() {
        $this->title = 'Магазин';
        $this->slug = 'Свежее и органическое';
        $this->desc = 'Свежее и органическое';
        $this->keywords = 'Свежее и органическое';


        $products = $this->getProducts();
        $cats = $this->getCats();
        $this->content = view('main.shop.content', compact('products','cats'));
        return $this->renderOutput();
    }

    public function getProducts() {
        return $this->prod_rep->get(['id', 'alias', 'title', 'price', 'img', 'per', 'description'], false,true);
    }
    public function getCats() {
        return $this->cat_rep->get(['id', 'title']);
    }

    public function show($id) {
        $product = $this->prod_rep->one($id);

        $this->title = 'Страница товара ' . $product->title;
        $this->slug = 'Свежее и органическое';
        $this->desc = 'Свежее и органическое';
        $this->keywords = 'Свежее и органическое';


        $this->content = view('main.shop.show', compact('product'));
        return $this->renderOutput();
    }


}
