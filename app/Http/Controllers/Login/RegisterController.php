<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index() {

        if(Auth::check()) {
            return redirect()->route('admin.index');
        }
        return view('auth_custom.register');



    }

    public function createUser(UserRequest $request) {
        if($request->isMethod('POST')) {
            $data = $request->except('_token');
            $user = User::create($data);
            $user->roles()->attach(3);
            if($user) {
                Auth::login($user);
                return redirect()->route('admin.index');
            }
            return redirect()->back()->with(['error' => 'Ошибка создания пользователя']);
        }
    }
}
