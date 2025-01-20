<?php

namespace Tests\Feature\Routes;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrarTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test access to the registrar dashboard route.
     */
    public function test_dashboard_route()
    {
        $user = User::factory()->create([
            'role' => 'registrar',  // Ensure the user has a 'registrar' role
        ]);

        $response = $this->actingAs($user)->get(route('registrar.dashboard'));
        $response->assertStatus(200);
    }

    /**
     * Test access to the record of students route.
     */
    public function test_record_of_students_route()
    {
        $user = User::factory()->create([
            'role' => 'registrar',  // Ensure the user has a 'registrar' role
        ]);

        $response = $this->actingAs($user)->get(route('registrar.record-of-students'));
        $response->assertStatus(200);
    }

    /**
     * Test access to the enrollment lists route.
     */
    public function test_enrollment_lists_route()
    {
        $user = User::factory()->create([
            'role' => 'registrar',  // Ensure the user has a 'registrar' role
        ]);

        $response = $this->actingAs($user)->get(route('registrar.enrollment-lists'));
        $response->assertStatus(200);
    }

    /**
     * Test the store functionality for enrollment lists.
     */
    public function test_store_enrollment_list()
    {
        $user = User::factory()->create([
            'role' => 'registrar',  // Ensure the user has a 'registrar' role
        ]);

        $response = $this->actingAs($user)->post(route('registrar.enrollment-lists.store'), [
            // Provide the necessary data for storing an enrollment list
        ]);

        $response->assertStatus(201);  // Assuming successful creation should return a 201 status
    }

    /**
     * Test the update functionality for enrollment lists.
     */
    public function test_update_enrollment_list()
    {
        $user = User::factory()->create([
            'role' => 'registrar',  // Ensure the user has a 'registrar' role
        ]);

        $response = $this->actingAs($user)->patch(route('registrar.enrollment-lists.update', ['student_id' => 1]), [
            // Provide the necessary data for updating an enrollment list
        ]);

        $response->assertStatus(200);  // Assuming successful update should return a 200 status
    }

    /**
     * Test the delete functionality for enrollment lists.
     */
    public function test_delete_enrollment_list()
    {
        $user = User::factory()->create([
            'role' => 'registrar',  // Ensure the user has a 'registrar' role
        ]);

        $response = $this->actingAs($user)->delete(route('registrar.enrollment-lists.destroy', ['student_number' => 12345]));

        $response->assertStatus(200);  // Assuming successful deletion should return a 200 status
    }
}
