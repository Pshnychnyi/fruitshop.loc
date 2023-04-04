<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\ReviewRequest;
use App\Repositories\ReviewRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReviewController extends MainController
{

    public $review_rep;

    public function __construct(ReviewRepository $review_rep)
    {
        $this->template = 'admin.review.index';
        $this->review_rep = $review_rep;
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

        $this->title = 'Отзывы';
        $reviews = $this->getReviews();

        $this->content = view('admin.review.content')->with('reviews', $reviews);

        return $this->renderOutput();
    }

    public function getReviews()
    {
        return $this->review_rep->get(['id', 'title', 'profession', 'description'], false, true);

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

        $this->title = 'Создание отзыва';

        $this->content = view('admin.review.create');

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request)
    {
        if(Gate::denies('CREATE_ITEMS')){
            return abort(404);
        }

        $result = $this->review_rep->createReview($request);
        if(is_array($result) && !empty($result['errors'])) {
            return redirect()->back()->with($result);
        }

        return redirect()->route('review.index')->with($result);
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

        $this->title = 'Редактирование отзыва';

        $review = $this->getReview($id);

        $this->content = view('admin.review.edit')->with('review', $review);
        return $this->renderOutput();
    }

    public function getReview($id) {

        return $this->review_rep->one($id) ?: false;
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

        $review = $this->getReview($id);

        $result = $this->review_rep->updateReview($request, $review);

        return (is_array($result) && !empty($result['errors'])) ? redirect()->back()->with($result) : redirect()->route('review.index')->with($result);

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
        $review = $this->getReview($id);

        $result = $this->review_rep->deleteReview($review);
        return (is_array($result) && !empty($result['errors'])) ? redirect()->back()->with($result) : redirect()->route('review.index')->with($result);
    }
}
