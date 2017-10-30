<?php

namespace Tests\Feature;

use App\Models\Meeting;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MeetingTest extends TestCase
{
    use DatabaseMigrations;

//    public function testAcessRouteMeeting()
//    {
//        $user = factory(\App\Models\User::class)->create();
//        factory(\App\Models\Room::class)->create();
//        factory(\App\Models\Meeting::class)->create();
//
//        $response = $this->actingAs($user)->get('/reunioes');
//
//        $meetings = Meeting::all();
//        $response->assertViewHas('meetings', $meetings);
//    }

    public function testPostRouteMeetingCreate()
    {
        $user = factory(\App\Models\User::class)->create();
        factory(\App\Models\Room::class)->create();

        $data = [
            'room_id' => 1,
            'date' => '29/10/2017',
            'time' => '00:00:00',
            'name' => 'Meeting 1',
            'description' => 'test description'
        ];

        $this->actingAs($user)->post('/reunioes/formulario',$data);

        $this->assertDatabaseHas('meetings', [
            'name' => 'Meeting 1','description' => 'test description','date_time' => '2017-10-29 00:00:00'
        ]);
    }

    public function testPostRouteMeetingCreateMoreOneMeetingByRoom()
    {
        $user = factory(\App\Models\User::class)->create();
        $user2 = factory(\App\Models\User::class)->create();
        factory(\App\Models\Room::class)->create();

        $data = [
            'room_id' => 1,
            'date' => '29/10/2017',
            'time' => '00:00:00',
            'name' => 'Meeting 1',
            'description' => 'test description'
        ];

        $this->actingAs($user)->post('/reunioes/formulario',$data);
        $this->assertDatabaseHas('meetings', [
            'name' => 'Meeting 1','description' => 'test description','date_time' => '2017-10-29 00:00:00'
        ]);

        $data = [
            'room_id' => 1,
            'date' => '29/10/2017',
            'time' => '00:00:00',
            'name' => 'Meeting 2',
            'description' => 'test description'
        ];

        $this->actingAs($user2)->post('/reunioes/formulario',$data);
        $this->assertDatabaseMissing('meetings', [
            'name' => 'Meeting 2','description' => 'test description','date_time' => '2017-10-29 00:00:00'
        ]);
    }

    public function testPostRouteMeetingCreateMoreOneMeetingByUser()
    {
        $user = factory(\App\Models\User::class)->create();
        $user2 = factory(\App\Models\User::class)->create();
        factory(\App\Models\Room::class)->create();

        $data = [
            'room_id' => 1,
            'date' => '29/10/2017',
            'time' => '00:00:00',
            'name' => 'Meeting 1',
            'description' => 'test description'
        ];

        $this->actingAs($user)->post('/reunioes/formulario',$data);
        $this->assertDatabaseHas('meetings', [
            'name' => 'Meeting 1','description' => 'test description','date_time' => '2017-10-29 00:00:00'
        ]);

        $data = [
            'room_id' => 2,
            'date' => '29/10/2017',
            'time' => '00:00:00',
            'name' => 'Meeting 2',
            'description' => 'test description'
        ];

        $this->actingAs($user2)->post('/reunioes/formulario',$data);

        $this->assertDatabaseMissing('meetings', [
            'name' => 'Meeting 2','description' => 'test description','date_time' => '2017-10-29 00:00:00'
        ]);
    }

    public function testPostRouteMeetingUpdate()
    {
        $user = factory(\App\Models\User::class)->create();
        factory(\App\Models\Room::class)->create();
        factory(\App\Models\Meeting::class)->create();

        $data = [
            'id' => 1,
            'room_id' => 1,
            'date' => '29/10/2017',
            'time' => '10:00:00',
            'name' => 'Meeting 2',
            'description' => 'test description'
        ];

        $this->actingAs($user)->put('/reunioes/edit',$data);

        $this->assertDatabaseHas('meetings', [
            'name' => 'Meeting 2','description' => 'test description','date_time' => '2017-10-29 10:00:00'
        ]);
    }

    public function testPostRouteMeetingUpdateMoreOneMeetingByRoom()
    {
        $user = factory(\App\Models\User::class)->create();
        factory(\App\Models\Room::class)->create();
        factory(\App\Models\Room::class)->create();
        factory(\App\Models\Meeting::class)->create();
        \App\Models\Meeting::create([
            'id' => 2,
            'user_id' => 1,
            'room_id' => 2,
            'date_time' => '2017-10-29 11:00:00',
            'name' => 'Meeting 2',
            'description' => 'test description'
        ]);

        $data = [
            'id' => 1,
            'room_id' => 1,
            'date' => '29/10/2017',
            'time' => '10:00:00',
            'name' => 'Meeting 3',
            'description' => 'test description'
        ];

        $this->actingAs($user)->put('/reunioes/edit',$data);

        $this->assertDatabaseHas('meetings', [
            'name' => 'Meeting 3','description' => 'test description','date_time' => '2017-10-29 10:00:00'
        ]);


        $data = [
            'id' => 2,
            'room_id' => 1,
            'date' => '29/10/2017',
            'time' => '10:00:00',
            'name' => 'Meeting 4',
            'description' => 'test description'
        ];

        $this->actingAs($user)->put('/reunioes/edit',$data);
        $this->assertDatabaseMissing('meetings', [
            'name' => 'Meeting 4','description' => 'test description','date_time' => '2017-10-29 10:00:00'
        ]);
    }

    public function testPostRouteMeetingUpdateMoreOneMeetingByUser()
    {
        $user = factory(\App\Models\User::class)->create();
        factory(\App\Models\Room::class)->create();
        factory(\App\Models\Room::class)->create();
        factory(\App\Models\Meeting::class)->create();
        \App\Models\Meeting::create([
            'id' => 2,
            'user_id' => 1,
            'room_id' => 2,
            'date_time' => '2017-10-29 11:00:00',
            'name' => 'Meeting 2',
            'description' => 'test description'
        ]);

        $data = [
            'id' => 1,
            'room_id' => 1,
            'date' => '29/10/2017',
            'time' => '10:00:00',
            'name' => 'Meeting 3',
            'description' => 'test description'
        ];

        $this->actingAs($user)->put('/reunioes/edit',$data);

        $this->assertDatabaseHas('meetings', [
            'name' => 'Meeting 3','description' => 'test description','date_time' => '2017-10-29 10:00:00'
        ]);

        $data = [
            'id' => 2,
            'room_id' => 2,
            'date' => '29/10/2017',
            'time' => '10:00:00',
            'name' => 'Meeting 4',
            'description' => 'test description'
        ];

        $this->actingAs($user)->put('/reunioes/edit',$data);
        $this->assertDatabaseMissing('meetings', [
            'name' => 'Meeting 4','description' => 'test description','date_time' => '2017-10-29 10:00:00'
        ]);
    }

    public function testPostRouteMeetingDelete()
    {
        $user = factory(\App\Models\User::class)->create();
        factory(\App\Models\Room::class)->create();
        factory(\App\Models\Meeting::class)->create();

        $data = [
            'id' => 1
        ];

        $this->actingAs($user)->delete('/reunioes/delete',$data);

        $this->assertDatabaseMissing('meetings', [
            'name' => 'Meeting 1'
        ]);
    }
}