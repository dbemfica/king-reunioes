<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    public function testAcessRouteUsers()
    {
        $user = factory(\App\Models\User::class)->create();
        $response = $this->actingAs($user)->get('/usuarios');

        $users = User::all();
        $response->assertViewHas('users', $users);
    }

    public function testPostRouteUsersCreate()
    {
        $user = factory(\App\Models\User::class)->create();

        $data = [
            'name' => 'Administrador 2',
            'email' => 'admin@admin.com',
            'password' => bcrypt('root')
        ];

        $this->actingAs($user)->post('/usuarios/formulario',$data);

        $this->assertDatabaseHas('users', [
            'name' => 'Administrador 2'
        ]);
    }

    public function testPostRouteUsersUpdate()
    {
        $user = factory(\App\Models\User::class)->create();

        $data = [
            'id' => 1,
            'name' => 'Administrador 2',
            'email' => 'admin@admin.com',
            'password' => bcrypt('root')
        ];

        $this->actingAs($user)->put('/usuarios/edit',$data);

        $this->assertDatabaseHas('users', [
            'id' => 1, 'name' => 'Administrador 2'
        ]);
    }

    public function testPostRouteUsersDelete()
    {
        $user = factory(\App\Models\User::class)->create();

        $data = [
            'id' => 1
        ];

        $this->actingAs($user)->delete('/usuarios/delete',$data);

        $this->assertDatabaseMissing('users', [
            'id' => 1, 'name' => 'Administrador'
        ]);
    }
}
