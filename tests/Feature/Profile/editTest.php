<?php

namespace Tests\Feature\Profile;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class editTest extends TestCase
{
    /**
     * Test if the profile edit page loads successfully.
     *
     * @return void
     */
    public function test_profile_edit_page_loads(): void
    {
        // Assuming the user is logged in and the route is protected by auth
        $user = \App\Models\User::factory()->create(); // Create a test user
        $response = $this->actingAs($user)->get(route('profile.edit')); // Use the correct route name

        $response->assertStatus(200); // Check that the page loads successfully
        $response->assertSee('Profile'); // Check that the 'Profile' heading is present
        $response->assertSee('Update your account\'s profile information and email address.'); // Check specific text
    }
}
