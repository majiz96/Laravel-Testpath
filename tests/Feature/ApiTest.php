<?php

namespace Tests\Feature;

use App\Models\Post;
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

    public function test_user_can_create_a_post()
    {
       $user = User::factory()->create();

       $response = $this->actingAs($user)->postJson('/api/posts',
           ['title' => 'Test title',
               'body' => 'Test body The body field is required and at least thirty character should be'
           ]);

       $response->assertCreated();
    }

    public function test_user_cannot_create_a_post_by_empty_title()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson('/api/posts',
        ['title' => '',
            'body' => 'Test body The body field is required and at least thirty character should be'
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrorFor('title');
    }

    public function test_can_get_posts(): void
    {
        Post::factory()->count(3)->create();

        $response = $this->getJson('/api/posts');

        $response->assertOk();

        $response->assertJsonCount(3, 'data');

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'body',
                ]
            ]
        ]);
    }

    public function test_can_show_a_post(): void
    {
        $post = Post::factory()->create();
        $response = $this->getJson("/api/posts/{$post->id}");

        $response->dump();

        $response->assertOk();
        $response->assertJsonStructure([ 'data' => ['id', 'title', 'body']]);
    }

    public function test_can_update_a_post(): void
    {
        $post = Post::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user,'sanctum')->putJson("/api/posts/{$post->id}",[
            'title' => 'Updated title',
            'body' => 'Test body The body field is required and at least thirty character should be',
        ]);

        $response->assertOk();

        $this->assertDatabaseHas('posts', [
            'title' => 'Updated title',
            'body' => 'Test body The body field is required and at least thirty character should be',
        ]);
    }

    public function test_guest_cannot_update_a_post(): void
    {
        $post = Post::factory()->create();

        $response = $this->putJson('/api/posts/' . $post->id, [
            'title' => 'Updated title',
            'body' => 'Test body The body field is required and at least thirty character should be',
        ]);

        $response->assertUnauthorized();
    }

}
