<?php

namespace Tests\Feature;

 use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use App\Models\User;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_home_page_is_available(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);

        $response->assertRedirect();
    }

    public function test_that_user_can_be_created(): void
    {
        $user = User::factory()->count(10)->create();

        $this->assertDatabaseCount('users', 10);
    }
    public function test_that_user_can_be_made(): void
    {
        $user = User::factory()->make();

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);
    }
    public function test_that_user_can_be_made_as_an_object(): void
    {
        $user = User::factory()->make();

        $this->assertInstanceOf(User::class, $user);
    }

    public function test_can_save_in_database(): void
    {
        $user = User::factory()->make();

        $this->assertDatabaseMissing('users', [
            'email' => $user->email,
        ]);
    }
}
