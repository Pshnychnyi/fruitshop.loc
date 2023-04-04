<?php

namespace App\Http\Controllers\Main;

use App\Repositories\DiscountRepository;
use App\Repositories\NewsRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ReviewRepository;
use App\Repositories\SliderRepository;


class IndexController extends SiteController
{
    public $rev_rep;
    public $slider_rep;
    public $prod_rep;
    public $news_rep;
    public $disc_rep;

    public function __construct(ReviewRepository $rev_rep, SliderRepository $slider_rep, ProductRepository $prod_rep, NewsRepository $news_rep, DiscountRepository $disc_rep) {
        parent::__construct();
        $this->template = 'main.index.index';
        $this->rev_rep = $rev_rep;
        $this->slider_rep = $slider_rep;
        $this->prod_rep = $prod_rep;
        $this->news_rep = $news_rep;
        $this->disc_rep = $disc_rep;
    }

    public function index() {

        $this->title = 'Главная';
        $this->desc = 'Органическая  информация';
        $this->keywords = 'Органическая  информация';

        $reviews = $this->getReviews();
        $sliders = $this->getSliders();
        $products = $this->getProducts();
        $news = $this->getNews();

        $discount = $this->disc_rep->get(['id', 'title', 'percent'], false, false, false ,1)->first();


        $discountProduct = $this->prod_rep->get(['id', 'alias', 'title', 'description', 'price', 'img', 'per', 'discount_id'],false,false, ['discount_id', '!=', null], 1)->first();


        $this->slider = view('main.slider', compact('sliders'));
        $this->content = view('main.index.content', compact('reviews', 'products', 'news', 'discountProduct', 'discount'));
        return $this->renderOutput();
    }

    public function getReviews() {
        return $this->rev_rep->get(['title', 'profession', 'img', 'description']);
    }
    public function getSliders() {
        return $this->slider_rep->get(['id', 'slug', 'title', 'description', 'first_link_name', 'first_link_path', 'second_link_name', 'second_link_path']);
    }
    public function getProducts() {
        return $this->prod_rep->get(['id', 'alias', 'title', 'price', 'img', 'per'], false,false, false, 3);
    }
    public function getNews() {
        return $this->news_rep->get(['id', 'alias', 'title', 'content', 'img', 'created_at', 'user_id', 'preview_text', 'preview_image'], false,false, false, 3);
    }

}
