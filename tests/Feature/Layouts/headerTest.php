<?php

namespace Tests\Feature\Layouts;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class headerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the header is visible for authenticated users.
     */
    public function test_authenticated_user_can_see_header(): void
    {
        // Create a mock authenticated user
        $user = User::factory()->create();

        // Act as the authenticated user
        $this->actingAs($user);

        // Send a GET request to the root URL
        $response = $this->get('/');

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert that the user's name is displayed in the header
        $response->assertSee("Hello, {$user->name}", false);
        $response->assertSee('<div class="header-title', false); // Check for header title class
        $response->assertSee('<button class="dropdown-button', false); // Ensure the dropdown is present
        $response->assertSee('<form method="POST" action="' . route('logout') . '"', false); // Check logout form
    }

    /**
     * Test if unauthenticated users cannot see the header.
     */
    public function test_unauthenticated_user_cannot_see_header(): void
    {
        // Ensure no user is authenticated
        auth()->logout();

        // Send a GET request to the root URL
        $response = $this->get('/');

        // Assert that the user's name and header-specific content are not visible
        $response->assertDontSee('<div class="header-wrapper', false);
        $response->assertDontSee('<button class="dropdown-button', false);

        // Optionally, check for a redirect to the login page
        $response->assertRedirect('/login');
    }

    /**
     * Test if the dropdown menu works for authenticated users.
     */
    public function test_dropdown_menu_is_visible_when_authenticated(): void
    {
        // Create a mock authenticated user
        $user = User::factory()->create();

        // Act as the authenticated user
        $this->actingAs($user);

        // Send a GET request to the root URL
        $response = $this->get('/');

        // Assert that the dropdown button and menu content are present
        $response->assertSee('<button class="dropdown-button', false);
        $response->assertSee('Profile', false);
        $response->assertSee('Log Out', false);
    }
}
