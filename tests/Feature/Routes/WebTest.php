<?php

namespace Tests\Feature\Routes;

use Tests\TestCase;
use App\Models\User;

class WebTest extends TestCase
{
    // Test profile edit route for unauthenticated user
    public function test_profile_edit_route_for_unauthenticated_user()
    {
        // Make a GET request to the profile edit route
        $response = $this->get(route('profile.edit'));

        // Assert that the user is redirected to the login page
        $response->assertRedirect(route('login'));
    }

    // Test profile update route for authenticated user
    public function test_profile_update_route_for_authenticated_user()
    {
        // Create and authenticate a user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Make a PATCH request to update the profile
        $response = $this->patch(route('profile.update'), [
            // Assuming your profile update requires these fields
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);

        // Assert that the response is a redirect (after updating)
        $response->assertStatus(302);
        // Optionally, check if it redirects to the correct route, for example:
        $response->assertRedirect(route('profile.edit'));
    }

    // Test profile delete route for authenticated user
    public function test_profile_delete_route_for_authenticated_user()
    {
        // Create and authenticate a user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Make a DELETE request to destroy the profile
        $response = $this->delete(route('profile.destroy'));

        // Assert that the response is a redirect (after deleting)
        $response->assertStatus(302);
        // Optionally, check if it redirects to the correct route
        $response->assertRedirect(route('index')); // or wherever you want to redirect after deletion
    }

    // Test view-test route
    public function test_view_test_route()
    {
        $response = $this->get('/view-test');
        $response->assertViewIs('layout.app');
    }
}
