<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CommentRequest;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends MainController
{
    /**
     * @var CommentRepository
     */
    public $comm_rep;

    public function __construct(CommentRepository $comm_rep)
    {
        $this->template = 'admin.comment.index';
        $this->comm_rep = $comm_rep;
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

        $this->title = 'Комментарии';
        $comments = $this->getComments();

        $this->content = view('admin.comment.content')->with('comments', $comments);

        return $this->renderOutput();
    }

    public function getComments()
    {
        return $this->comm_rep->get(['id', 'content', 'name', 'email', 'parent_id'], false, true);

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

        $this->title = 'Создание тега';

        $this->content = view('admin.comment.create');

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        if(Gate::denies('CREATE_ITEMS')){
            return abort(404);
        }

        $result = $this->comm_rep->createComment($request);
        if(is_array($result) && !empty($result['errors'])) {
            return redirect()->back()->with($result);
        }

        return redirect()->route('comment.index')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Gate::denies('ADMIN_VIEW')){
            return abort(404);
        }

        $this->title = 'Комментарий: ' . $id ;
        $comment = $this->getComment($id);

        $this->content = view('admin.comment.show')->with('comment', $comment);

        return $this->renderOutput();
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

        $this->title = 'Редактирование тега';

        $comment = $this->getComment($id);

        $this->content = view('admin.comment.edit')->with('comment', $comment);
        return $this->renderOutput();
    }

    public function getComment($id) {

        return $this->comm_rep->one($id) ?: false;
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

        $comment = $this->getComment($id);

        $result = $this->comm_rep->updateComment($request, $comment);

        return (is_array($result) && !empty($result['errors'])) ? redirect()->back()->with($result) : redirect()->route('comment.index')->with($result);

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

        $comment = $this->getComment($id);

        $result = $this->comm_rep->deleteComment($comment);
        return (is_array($result) && !empty($result['errors'])) ? redirect()->back()->with($result) : redirect()->route('comment.index')->with($result);
    }
}
