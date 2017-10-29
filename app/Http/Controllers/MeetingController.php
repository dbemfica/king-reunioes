<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MeetingController extends Controller
{
    public function index()
    {
        $meetings = Meeting::all();
        return view('meetings.index',
            ['meetings' => $meetings]
        );
    }

    public function showForm()
    {
        $rooms = Room::all();
        return view('meetings.form',
            ['rooms' => $rooms]
        );
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('meetings.form')->withErrors($validator)->withInput();
        }

        //LOAD DATA OF ROOM
        $room = Room::find($request->input('room_id'));


        $meeting = new Meeting();
        $meeting->user_id = Auth::user()->id;
        $meeting->room_id = $room->id;

        $data_time = \DateTime::createFromFormat('d/m/Y H:i:s', $request->input('date').' '.$request->input('time'));
        $meeting->date_time = $data_time->format('Y-m-d H:i:s');

        $meeting->name = $request->input('name');
        $meeting->description = $request->input('description');


        if(!$this->checkAvailability($room,$meeting)){
            return redirect()->route('meetings.form')->withErrors('Está sala já possui uma reunião para ocasião');
        }

        if($meeting->save()){
            return redirect()->route('meetings.index')->with('success', 'Reunião cadastrada com sucesso!');
        }
    }

    public function showEditForm($id)
    {
        $rooms = Room::all();
        $meeting = Meeting::find($id);
        return view('meetings.edit',[
            'meeting' => $meeting,
            'rooms' => $rooms
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('meetings.edit',['id' => $request->input('id')])->withErrors($validator)->withInput();
        }

        $meeting = Meeting::find($request->input('id'));
        $meeting->user_id = Auth::user()->id;
        $meeting->room_id = $request->input('room_id');

        $data_time = \DateTime::createFromFormat('d/m/Y H:i:s', $request->input('date').' '.$request->input('time'));
        $meeting->date_time = $data_time->format('Y-m-d H:i:s');

        $meeting->name = $request->input('name');
        $meeting->description = $request->input('description');
        if($meeting->save()){
            return redirect()->route('meetings.index')->with('success', 'Reunião atualizada com sucesso!');
        }
    }

    public function delete(Request $request)
    {
        Meeting::destroy($request->input('id'));
        return redirect()->route('meetings.index')->with('success', 'Reunião Removida com sucesso!');
    }

    public function checkAvailability($room,$meeting)
    {
        foreach( $room->meetings as $m ){
            if( $m->date_time == $meeting->date_time ){
                return false;
            }
        }
        return true;
    }
}
