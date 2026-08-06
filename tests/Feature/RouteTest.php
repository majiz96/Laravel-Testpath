<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
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
}
