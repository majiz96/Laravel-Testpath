<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_form_can_be_submitted(): void
    {
        $response = $this->post('post',['title'=>'Test Post']);

        $response->assertOk();
    }
    public function test_form_cannot_be_submitted_by_invalid_data(): void
    {
        $response = $this->post('post',['title'=>'Te']);

        $response->assertSessionHasErrors('title');
    }

    public function test_posts_pagination(): void
    {
        Post::factory()->count(12)->create();

        $response = $this->getJson('/api/posts');

        $response->assertOk();

        $response->assertJsonCount(5, 'data');
        $response->assertJsonPath('meta.current_page', 1);
        $response->assertJsonPath('meta.total', 12);

    }
    public function test_posts_pagination_can_change(): void
    {
        Post::factory()->count(12)->create();

        $response = $this->getJson('/api/posts?perPage=10');

        $response->assertOk();

        $response->assertJsonCount(10, 'data');
        $response->assertJsonPath('meta.per_page', 10);
    }

    public function test_posts_pagination_can_be_on_different_pages(): void
    {
        Post::factory()->count(22)->create();

        $response = $this->getJson('/api/posts?perPage=10&page=2');

        $response->assertOk();

        $response->assertJsonCount(10, 'data');
        $response->assertJsonPath('meta.current_page', 2);
        $response->assertJsonPath('meta.per_page', 10);
    }
}
