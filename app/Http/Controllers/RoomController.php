<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index',
            ['rooms' => $rooms]
        );
    }

    public function showForm()
    {
        return view('rooms.form');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('rooms.form')->withErrors($validator)->withInput();
        }

        $room = new Room();
        $room->name = $request->input('name');
        $room->description = $request->input('description');
        if($room->save()){
            return redirect()->route('rooms.index')->with('success', 'Sala cadastrada com sucesso!');
        }
    }

    public function showEditForm($id)
    {
        $room = Room::find($id);
        return view('rooms.edit',[
            'room' => $room
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('rooms.edit',['id' => $request->input('id')])->withErrors($validator)->withInput();
        }

        $room = Room::find($request->input('id'));
        $room->name = $request->input('name');
        $room->description = $request->input('description');
        if($room->save()){
            return redirect()->route('rooms.index')->with('success', 'Sala atualizada com sucesso!');
        }
    }

    public function delete(Request $request)
    {
        Room::destroy($request->input('id'));
        return redirect()->route('rooms.index')->with('success', 'Sala Removida com sucesso!');
    }
}
