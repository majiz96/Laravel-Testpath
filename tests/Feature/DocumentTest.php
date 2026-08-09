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

    public function test_other_users_not_allowed_to_update_document(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $document = Document::factory()->create(['user_id' => $user->id]);

        $token = $otherUser->createToken('test-token')->plainTextToken;

        $response = $this->withToken($token)
            ->putJson("/api/documents/{$document->id}" , [
                'title'=>'Document test title',
                'body'=>'Document test body',
            ]);

        $response->assertForbidden();
    }

    public function test_user_allowed_to_update_document(): void
    {
        $user = User::factory()->create();
        $document = Document::factory()->create(['user_id' => $user->id]);
        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withToken($token)
            ->putJson("/api/documents/{$document->id}" , [
                'title'=>'Document test title',
                'body'=>'Document test body',
            ]);

        $response->assertOk();

        $this->assertDatabaseHas('documents', [
            'id' => $document->id,
            'title'=>'Document test title',
            'body'=>'Document test body',
        ]);
    }

    public function test_other_user_not_allowed_to_delete_document(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $document = Document::factory()->create(['user_id' => $user->id]);

        $token = $otherUser->createToken('test-token')->plainTextToken;

        $response = $this->withToken($token)->deleteJson("/api/documents/{$document->id}");

        $response->assertForbidden();

        $this->assertDatabaseHas('documents', ['id' => $document->id]);
    }
    public function test_user_allowed_to_delete_document(): void
    {
        $user = User::factory()->create();
        $document = Document::factory()->create(['user_id' => $user->id]);

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withToken($token)->deleteJson("/api/documents/{$document->id}");

       $response->assertNoContent();

       $this->assertDatabaseMissing('documents', ['id' => $document->id]);
    }

    public function test_user_cannot_update_document_by_invalid_data(): void
    {
        $user = User::factory()->create();
        $document = Document::factory()->create(['user_id' => $user->id]);

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withToken($token)
            ->putJson("/api/documents/{$document->id}" , [
                'title'=>'Document test title'
            ]);

        $response->assertUnprocessable();

        $response->assertJsonValidationErrors('body');
    }
}
