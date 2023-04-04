<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\CommentRepository;
use App\Repositories\NewsRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Gate;

class IndexController extends MainController
{

    public $content;
    private $prod_rep;
    private $user_rep;
    private $news_rep;
    private $comm_rep;

    public function __construct(ProductRepository $prod_rep, UserRepository $user_rep, NewsRepository $news_rep, CommentRepository $comm_rep)
    {
        $this->template = 'admin.index.index';
        $this->prod_rep = $prod_rep;
        $this->user_rep = $user_rep;
        $this->news_rep = $news_rep;
        $this->comm_rep = $comm_rep;
    }

    public function index() {

        if(Gate::denies('VIEW_ADMIN')){
            return abort(404);
        }

        $this->title = 'Главная';
        $productsCount = $this->prod_rep->get(['id'])->count();
        $usersCount = $this->user_rep->get(['id'])->count();
        $newsCount = $this->news_rep->get(['id'])->count();
        $commentsCount = $this->comm_rep->get(['id'])->count();
        $this->content = view('admin.index.content', compact('productsCount', 'usersCount', 'newsCount', 'commentsCount'));
        return $this->renderOutput();
    }
}
