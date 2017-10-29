<?php

namespace Tests\Feature;

use App\Models\Room;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RoomTest extends TestCase
{
    use DatabaseMigrations;

    public function testAcessRouteRooms()
    {
        $user = factory(\App\Models\User::class)->create();
        factory(\App\Models\Room::class)->create();

        $response = $this->actingAs($user)->get('/salas');

        $rooms = Room::all();
        $response->assertViewHas('rooms', $rooms);
    }

    public function testPostRouteRoomsCreate()
    {
        $user = factory(\App\Models\User::class)->create();

        $data = [
            'name' => 'room 1',
            'description' => 'test description'
        ];

        $this->actingAs($user)->post('/salas/formulario',$data);

        $this->assertDatabaseHas('rooms', [
            'name' => 'room 1','description' => 'test description'
        ]);
    }

    public function testPostRouteRoomsUpdate()
    {
        $user = factory(\App\Models\User::class)->create();

        factory(\App\Models\Room::class)->create();

        $data = [
            'id' => 1,
            'name' => 'room 2',
            'description' => 'test description'
        ];

        $this->actingAs($user)->put('/salas/edit',$data);

        $this->assertDatabaseHas('rooms', [
            'id' => 1, 'name' => 'room 2'
        ]);
    }

    public function testPostRouteRoomsDelete()
    {
        $user = factory(\App\Models\User::class)->create();

        $data = [
            'id' => 1
        ];

        $this->actingAs($user)->delete('/salas/delete',$data);

        $this->assertDatabaseMissing('rooms', [
            'name' => 'room 1','description' => 'test description'
        ]);
    }
}