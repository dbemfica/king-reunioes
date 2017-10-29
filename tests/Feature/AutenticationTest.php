<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AutenticationTest extends TestCase
{
    use DatabaseMigrations;

    public function testAcessPageHome()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testAcessDashboardWithoutLogin()
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(302);
    }

    public function testAcessDashboardWithLogin()
    {
        $user = factory(\App\Models\User::class)->create();
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
    }
}
