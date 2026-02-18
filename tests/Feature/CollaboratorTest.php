<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Collaborator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CollaboratorTest extends TestCase
{
    // use RefreshDatabase;

    private function authenticatedUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
    }

    public function test_user_can_access_collaborators_module()
    {
        $this->authenticatedUser();

        $response = $this->getJson('/api/collaborators');

        $response->assertStatus(200);
    }

    public function test_system_shows_collaborators_list()
    {
        $this->authenticatedUser();

        Collaborator::factory()->count(3)->create();

        $response = $this->getJson('/api/collaborators');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_user_can_create_collaborator()
    {
        $this->authenticatedUser();

        $data = [
            'first_name' => 'Juan',
            'last_name' => 'Perez',
            'document_number' => '12345678',
            'email' => 'juan@test.com',
            'phone' => '3001234567',
        ];

        $response = $this->postJson('/api/collaborators', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('collaborators', [
            'email' => 'juan@test.com'
        ]);
    }

    public function test_user_can_edit_collaborator()
    {
        $this->authenticatedUser();

        $collaborator = Collaborator::factory()->create();

        $data = [
            'first_name' => 'Carlos',
            'last_name' => 'Gomez',
            'document_number' => $collaborator->document_number,
            'email' => $collaborator->email,
            'phone' => '3111111111',
        ];

        $response = $this->putJson("/api/collaborators/{$collaborator->id}", $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('collaborators', [
            'first_name' => 'Carlos'
        ]);
    }

    public function test_validation_fails_if_required_fields_missing()
    {
        $this->authenticatedUser();

        $response = $this->postJson('/api/collaborators', []);

        $response->assertStatus(422);
    }

    public function test_user_can_view_single_collaborator()
    {
        $this->authenticatedUser();

        $collaborator = Collaborator::factory()->create();

        $response = $this->getJson("/api/collaborators/{$collaborator->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $collaborator->id
                 ]);
    }

    public function test_user_can_deactivate_collaborator()
    {
        $this->authenticatedUser();

        $collaborator = Collaborator::factory()->create();

        $response = $this->patchJson("/api/collaborators/{$collaborator->id}/deactivate");

        $response->assertStatus(200);

        $this->assertDatabaseHas('collaborators', [
            'id' => $collaborator->id,
            'status' => 'inactive'
        ]);
    }
}
