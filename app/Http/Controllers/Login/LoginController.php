<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController
{
    public function __invoke(Request $request) {
        if($request->isMethod('GET')) {
            if(Auth::check()) {
                return redirect()->route('admin.index');
            }
            return view('auth_custom.login');
        }else{
            $data = $request->only(['email', 'password']);
            if(Auth::attempt($data)) {
               return redirect()->route('admin.index');
            }

            return redirect()->back()->with(['error' => 'Пользователь с такими данными не найден']);
        }

    }
}
