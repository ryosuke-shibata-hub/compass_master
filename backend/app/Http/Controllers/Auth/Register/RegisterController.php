<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\User;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    //
    //ユーザー登録画面
    public function registerForm() {
        return view('Auth.register');
    }

    //ユーザー登録処理
    public function register(RegisterRequest $request) {

        $User = new User;

        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);

        $User->fill($data)->save();

        return redirect()->route('register.added');
    }

    //ユーザー登録完了画面
    public function registerAdded() {
        return view('Auth.added');
    }
}
