<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function showFormLogin(){
        return view('login');
    }

    public function actionLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            return redirect()->route('dashboard');
        }
        return redirect()->route('login')->withErrors("E-mail ou Senha incorreto")->withInput();
    }

    function dashboard(){
        return view('dashboard');
    }

    function index(){
        return view('users.index');
    }
}
