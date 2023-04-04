<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Spatie\Menu\Link;
use Spatie\Menu\Menu;

class MainController extends Controller
{
    protected $content;
    protected $template;
    protected $title;
    protected $vars = [];



    public function renderOutput() {
        $this->vars = Arr::add($this->vars, 'title', $this->title);

        $menu = $this->getMenu();

        $navigation = view('admin.navigation')->with('menu', $menu)->render();
        $this->vars = Arr::add($this->vars, 'navigation', $navigation);

        if($this->content) {
            $this->vars = Arr::add($this->vars, 'content', $this->content);
        }
        $footer = view('admin.footer')->render();
        $this->vars = Arr::add($this->vars, 'footer', $footer);
        return view($this->template)->with($this->vars);
    }

    protected function getMenu(): string
    {
        return Menu::new()
            ->addClass('nav nav-pills nav-sidebar flex-column')
            ->setAttributes(['data-widget' => 'treeview', 'role' => 'menu', 'data-accordion' => 'false'])
            ->add(Link::to(route('team.index'), '<i class="nav-icon fas fa-users"></i><p>Сотрудники</p>')
                ->addParentClass('nav-item')
                ->addClass('nav-link')
            )
            ->add(Link::to(route('category.index'), '<i class="nav-icon fas fa-server"></i><p>Категории</p>')
                ->addParentClass('nav-item')
                ->addClass('nav-link')
            )
            ->add(Link::to( route('tag.index') , '<i class="nav-icon fas fa-tags"></i><p>Теги</p>')
                ->addParentClass('nav-item')
                ->addClass('nav-link')
            )
            ->add(Link::to(route('product.index'), '<i class="nav-icon fas fa-cheese"></i><p>Продукты</p>')
                ->addParentClass('nav-item')
                ->addClass('nav-link')
            )
            ->add(Link::to(route('news.index'), '<i class="nav-icon fas fa-newspaper"></i><p>Новости</p>')
                ->addParentClass('nav-item')
                ->addClass('nav-link')
            )
            ->add(Link::to(route('user.index'), '<i class="nav-icon fas fa-users"></i><p>Пользователи</p>')
                ->addParentClass('nav-item')
                ->addClass('nav-link')
            )
            ->add(Link::to(route('comment.index'), '<i class="nav-icon fas fa-comments"></i><p>Комментарии</p>')
                ->addParentClass('nav-item')
                ->addClass('nav-link')
            )
            ->add(Link::to(route('permission.index'), '<i class="nav-icon fas fa-user-tag"></i><p>Роли</p>')
                ->addParentClass('nav-item')
                ->addClass('nav-link')
            )
            ->add(Link::to(route('slider.index'), '<i class="nav-icon fas fa-images"></i><p>Слайдер</p>')
                ->addParentClass('nav-item')
                ->addClass('nav-link')
            )
            ->add(Link::to(route('review.index'), '<i class="nav-icon fas fa-comment"></i><p>Отзывы</p>')
                ->addParentClass('nav-item')
                ->addClass('nav-link')
            )
            ->add(Link::to(route('discount.index'), '<i class="nav-icon fas fa-percent"></i><p>Скидки</p>')
                ->addParentClass('nav-item')
                ->addClass('nav-link')
            )
        ->render();
    }
}
