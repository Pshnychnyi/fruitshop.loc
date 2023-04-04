<?php

namespace App\Http\Controllers\Main;


use App\Repositories\DiscountRepository;
use App\Repositories\ReviewRepository;
use App\Repositories\TeamRepository;

class AboutController extends SiteController
{
    public $team_rep;
    public $rev_rep;
    public $disc_rep;

    public function __construct(TeamRepository $team_rep, ReviewRepository $rev_rep,  DiscountRepository $disc_rep) {
        parent::__construct();
        $this->template = 'main.about.index';
        $this->team_rep = $team_rep;
        $this->rev_rep = $rev_rep;
        $this->disc_rep = $disc_rep;

    }

    public function index() {
        $this->title = 'О нас';
        $this->slug = 'Мы продаем свежие фрукты';
        $this->desc = 'Мы продаем свежие фрукты';
        $this->keywords = 'Мы продаем свежие фрукты';

        $teams = $this->getTeams();
        $reviews = $this->getReviews();
        $discount = $this->disc_rep->get(['id', 'title', 'percent'], false, false, false ,1)->first();


        $this->content = view('main.about.content', compact('teams', 'reviews', 'discount'));
        return $this->renderOutput();
    }

    public function getTeams() {
        return $this->team_rep->get(['name', 'profession', 'img']);
    }
    public function getReviews() {
        return $this->rev_rep->get(['title', 'profession', 'img', 'description']);
    }

}
