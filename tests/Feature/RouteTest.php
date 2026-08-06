<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_test_route_is_available(): void
    {
        $response = $this->get('/test');

        $response->assertStatus(200);
    }

    public function test_the_message_is_visible()
    {
        $response = $this->get('/test');
        $response->assertSee('Hello Test');
    }
    public function test_the_message_is_visible_and_ok()
    {
        $response = $this->get('/testOk');
        $response->assertSee('Hello Test');
        $response->assertOk('Hello Test');

//        assertOk == assertStatus(200)
    }

    public function test_authenticated_user_can_access_route()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/home');
        $response->assertOk();
    }

    public function test_guests_can_not_access_route()
    {
        $response = $this->get('/home');
        $response->assertRedirect('/login');
    }

}
