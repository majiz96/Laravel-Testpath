<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
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
}
