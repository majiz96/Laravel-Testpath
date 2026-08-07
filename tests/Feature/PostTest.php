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
}
