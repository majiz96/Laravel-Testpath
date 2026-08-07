<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_go_to_profile_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->getJson('/api/profile')->assertOk();
    }
    public function test_guest_cannot_go_to_profile_page()
    {
        $this->getJson('/api/profile')->assertUnauthorized();
    }
}
