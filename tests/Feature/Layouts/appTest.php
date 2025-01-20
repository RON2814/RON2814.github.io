<?php

namespace Tests\Feature\Layouts;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class appTest extends TestCase
{
    /**
     * Test if the main layout loads correctly.
     */
    public function test_layout_contains_expected_elements(): void
    {
        // Send a GET request to the root URL
        $response = $this->get('/');

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Check for specific elements in the layout
        $response->assertSee('<title>', false); // Ensure a title tag exists
        $response->assertSee('Welcome,', false); // Check for a greeting message
        $response->assertSee('sidebar', false); // Ensure the sidebar class is present
        $response->assertSee('main-content', false); // Ensure the main content class is present
        $response->assertSee('burger-icon', false); // Ensure the burger icon for mobile is present

        // Check for navigation links
        $response->assertSee('Profile', false); // Ensure the Profile link is visible
        $response->assertSee('Log Out', false); // Ensure the Log Out button is visible
    }

    /**
     * Test if the page handles unauthenticated users correctly.
     */
    public function test_unauthenticated_user_sees_login_page(): void
    {
        // Log out any authenticated user
        auth()->logout();

        // Attempt to access the root URL
        $response = $this->get('/');

        // Assert redirection to the login page
        $response->assertRedirect('/login');
    }

    /**
     * Test if the authenticated user sees their specific role's navigation.
     */
    public function test_authenticated_user_sees_correct_sidebar(): void
    {
        // Create a mock authenticated user with a specific role
        $user = \App\Models\User::factory()->create([
            'role_id' => 1, // Student role
        ]);

        // Act as the authenticated user
        $this->actingAs($user);

        // Send a GET request to the root URL
        $response = $this->get('/');

        // Assert that the response contains the student's sidebar
        $response->assertSee('student-navbar', false);
    }
}
