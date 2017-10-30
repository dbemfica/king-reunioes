<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Room;
use App\Models\User;
use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Collection;
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

        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')], false)) {
            return redirect()->route('dashboard');
        }
        return redirect()->route('login')->withErrors("E-mail ou Senha incorreto")->withInput();
    }

    function actionLogout(){
        Auth::logout();
        return redirect()->route('login');
    }

    function dashboard(){

        $rooms = Room::All();
        $meetings = Meeting::All();

        //COUNTS
        $usersCount = User::All()->count();
        $roomsCount = $rooms->count();
        $meetingsCount = $meetings->count();

        //SCHENDULES
        $data = [];
        $now = new \DateTime();
        $now->setTime($now->format('H'),0,0);

        $j = 0;
        for( $i = 0; $i < 48; $i++ ){
            $now->add(new \DateInterval("PT1H"));
            foreach ($rooms as $room){
                $data[$j]['room_name'] = $room->name;
                $data[$j]['room_id'] = $room->id;
                $data[$j]['date'] = $now->format('Y-m-d H:i:s');
                if( count($meetings) > 0 ){
                    foreach ($meetings as $meeting){
                        if( $meeting->room_id == $data[$j]['room_id'] && $meeting->date_time == $data[$j]['date'] ){
                            $data[$j]['available'] = false;
                            break;
                        }
                        $data[$j]['available'] = true;
                    }
                }else{
                    $data[$j]['available'] = true;
                }
                $j++;
            }
        }

        $schendules = new Collection($data);

        return view('dashboard',[
            'usersCount' => $usersCount,
            'roomsCount' => $roomsCount,
            'meetingsCount' => $meetingsCount,
            'schendules' => $schendules,
        ]);
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
