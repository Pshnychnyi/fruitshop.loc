<?php

namespace App\Http\Controllers\Main;


use App\Mail\ContactMail;
use App\Repositories\ReviewRepository;
use App\Repositories\TeamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class ContactController extends SiteController
{

    public function __construct() {
        parent::__construct();
        $this->template = 'main.contact.index';


    }

    public function index() {
        $this->title = 'Контакты';
        $this->slug = 'Мы на связи 24/7';
        $this->desc = 'Мы на связи 24/7';
        $this->keywords = 'Мы на связи 24/7';


        $this->content = view('main.contact.content');
        return $this->renderOutput();
    }

    public function send(Request $request) {
        $data = $request->except('_token');

        $validator = Validator::make($data, [
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email',
            'phone' => 'string|min:3|max:20',
            'subject' => 'string|min:3|max:255',
            'message' => 'string|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        Mail::to('artem0096@gmail.com')->queue(new ContactMail($data));

        return response()->json(['success' => 'Сообщение отправлено! Спасибо за Ваш отзыв']);
    }


}
