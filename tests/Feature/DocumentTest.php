<?php

namespace Tests\Feature;

use App\Models\Document;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DocumentTest extends TestCase
{
    use RefreshDatabase;
    public function test_owner_can_update_document(): void
    {
        $user = User::factory()->create();

        $document = Document::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->assertTrue(
            $user->can('update', $document)
        );
    }
    public function test_other_users_cannot_update_document(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $document = Document::factory()->create(['user_id' => $user->id]);
        $this->assertFalse($otherUser->can('update', $document));
    }
}
