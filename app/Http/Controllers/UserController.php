<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function index()
    {
        $users = User::all();
        return view('users.index',
            ['users' => $users]
        );
    }

    public function showForm()
    {
        return view('users.form');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.form')->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        if($user->save()){
            return redirect()->route('users.index')->with('success', 'Usuário cadastrado com sucesso!');
        }
    }

    public function showEditForm($id)
    {
        $user = User::find($id);
        return view('users.edit',[
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit',['id' => $request->input('id')])->withErrors($validator)->withInput();
        }

        $user = User::find($request->input('id'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if( $request->input('password') !== null ){
            $user->password = bcrypt($request->input('password'));
        }
        if($user->save()){
            return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
        }
    }

    public function delete(Request $request)
    {
        User::destroy($request->input('id'));
        return redirect()->route('users.index')->with('success', 'Usuário Removido com sucesso!');
    }
}
