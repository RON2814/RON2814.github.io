<?php

namespace Tests\Feature\Layouts;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class guestTest extends TestCase
{
    /**
     * Test if the guest layout loads correctly.
     */
    public function test_guest_layout_contains_expected_elements(): void
    {
        // Send a GET request to the root URL
        $response = $this->get('/');

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Check for the presence of key layout elements
        $response->assertSee('<!DOCTYPE html>', false); // Ensure the HTML document starts correctly
        $response->assertSee('<title>', false); // Check for a title tag
        $response->assertSee('<x-application-logo', false); // Ensure the application logo component is present
        $response->assertSee('min-h-screen', false); // Check for the layout wrapper class
        $response->assertSee('sm:max-w-md', false); // Check for the form container class

        // Check if the dark mode class is applied
        $response->assertSee('dark:bg-gray-900', false);
    }

    /**
     * Test if unauthenticated users can access the guest layout.
     */
    public function test_unauthenticated_user_can_access_guest_layout(): void
    {
        // Log out any authenticated user
        auth()->logout();

        // Send a GET request to the login page (example of a guest page)
        $response = $this->get('/login');

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert that the guest layout is displayed
        $response->assertSee('<x-application-logo', false); // Ensure the application logo is present
        $response->assertSee('sm:max-w-md', false); // Ensure the guest form wrapper is present
    }

    /**
     * Test if authenticated users are redirected from guest pages.
     */
    public function test_authenticated_user_is_redirected(): void
    {
        // Create a mock authenticated user
        $user = \App\Models\User::factory()->create();

        // Act as the authenticated user
        $this->actingAs($user);

        // Attempt to access the login page (a guest-only page)
        $response = $this->get('/login');

        // Assert that the authenticated user is redirected (e.g., to the dashboard)
        $response->assertRedirect('/dashboard');
    }
}
