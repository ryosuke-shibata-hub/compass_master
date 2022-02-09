<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function loginForm() {

        return view('Auth.login');
    }

    public function login(Request $request) {

        $data['email'] = $request->email;
        $data['password'] = $request->password;

        if (Auth::attempt($data)) {
            return redirect()->route('userPostIndex');
        }
        return back()
            ->with('login_erro','*メールアドレスまたはパスワードが違います。');
    }

    public function logout() {

        Auth::logout();

        return redirect()->route('loginForm');
    }
}
