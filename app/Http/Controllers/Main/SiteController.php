<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Spatie\Menu\Link;
use Spatie\Menu\Menu;

class SiteController extends Controller
{
    protected $content;
    protected $template;
    protected $slider;
    protected $vars = [];
    protected $cookie;
    protected $cart = false;
    protected $count = 0;

    protected $title = '';
    protected $keywords = '';
    protected $desc = '';
    protected $slug = '';

    public function __construct() {
        $this->getCart();
        $this->count = !empty($this->cart) ? $this->cart->getCountItems() : 0;
    }

    private function getCart() {
        if(Cookie::get('cart_id')) {
            $cart_id = explode('|', Crypt::decrypt(Cookie::get('cart_id'), false))[1];
        }

        if (!empty($cart_id)) {
            try {
                $this->cart = Cart::findOrFail($cart_id);
            } catch (ModelNotFoundException $e) {
                $this->cart = Cart::create();
            }
        } else {
            $this->cart = Cart::create();
        }
        Cookie::queue('cart_id', $this->cart->id, 525600);
    }


    public function renderOutput() {
        $this->vars = Arr::add($this->vars, 'title', $this->title);
        $this->vars = Arr::add($this->vars, 'keywords', $this->keywords);
        $this->vars = Arr::add($this->vars, 'desc', $this->desc);

        $menu = $this->getMenu();

        $navigation = view('main.navigation')->with('menu', $menu)->render();
        $this->vars = Arr::add($this->vars, 'navigation', $navigation);

        $breadcrumbs = view('main.breadcrumbs')->with(['slug'=> $this->slug, 'title' => $this->title])->render();
        $this->vars = Arr::add($this->vars, 'breadcrumbs', $breadcrumbs);

        if($this->slider){
            $this->vars = Arr::add($this->vars, 'slider', $this->slider);
        }
        if($this->content) {
            $this->vars = Arr::add($this->vars, 'content', $this->content);
        }
        $footer = view('main.footer')->render();
        $this->vars = Arr::add($this->vars, 'footer', $footer);
        if($this->cookie) {
            Cookie::queue($this->cookie);
        }
        return view($this->template)->with($this->vars);
    }

    public function getMenu(): string
    {
       return Menu::new()
           ->add(Link::to(route('main.index'), 'Главная'))
           ->add(Link::to(route('main.about'), 'О нас'))
           ->add(Link::to(route('main.news'), 'Новости'))
           ->add(Link::to(route('main.contact'), 'Контакты'))
           ->add(Link::to(route('main.shop'), 'Магазин'))
           ->submenu('', Menu::new()
               ->setWrapperTag('div')
               ->withoutParentTag()
//               ->link(route('main.cart'), '<i class="fas fa-shopping-cart"></i>(<span id="count">' . $this->count .'</span>)')
               ->link(route('main.cart'), "<i class='fa fa-shopping-cart'></i><span id='count' class='cart-count'>{$this->count}</span>")
               ->link('#', '<i class="fas fa-search"></i>')
               ->each(function(Link $link){
                   if(strpos($link->url(), 'cart')) {
                       $link->addClass('shopping-cart');
                   }else{
                       $link->addClass('mobile-hide search-bar-icon');
                   }
               })
               ->addClass('header-icons')
           );


    }
}
