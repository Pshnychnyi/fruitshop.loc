<?php

namespace App\Http\Controllers\Main;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CommentController extends SiteController
{
    private $comment;

    public function __construct(Comment $comment)
    {
        parent::__construct();
        $this->template = 'main.comment.index';
        $this->comment = $comment;
    }


    public function store(Request $request) {
        $data = $request->except('_token', 'comment_post_ID', 'comment_parent');

        $data['news_id'] = $request->input('comment_post_ID') ?? '0';
        $data['parent_id'] = $request->input('comment_parent');


        if(empty($data)) {
           return ['error' => 'Нет данных'];
        }

        $validator = Validator::make($data, [
            'content' => 'required|min:3',
        ]);

        $validator->sometimes(['name','email'],'required|max:255',function($input) {
            return !Auth::check();
        });

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $data['email'] = (!empty($data['email']) ? $data['email'] : Auth::user()->email);
        $data['name'] = (!empty($data['name']) ? $data['name'] : Auth::user()->name);



        if($this->comment->create($data)) {


            $commentView = view('main.news.one_comment')->with('item', $data)->render();

            return response()->json(['success' => 'Спасибоо за ваш отзыв!!', 'comment' => $commentView, 'data' => $data]);
        }

        exit();
    }

}
