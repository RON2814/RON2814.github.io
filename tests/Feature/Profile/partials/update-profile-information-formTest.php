<?php

namespace Tests\Feature\Profile\partials;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class updateProfileInformationFormTest extends TestCase
{
    /**
     * Test if the profile information update page is accessible.
     *
     * @return void
     */
    public function test_update_profile_information_page_is_accessible(): void
    {
        // Simulate an authenticated user
        $this->actingAs($user = \App\Models\User::factory()->create());

        // Get the response when accessing the profile update page
        $response = $this->get(route('profile.update'));

        // Assert that the page returns a successful status
        $response->assertStatus(200);
    }

    /**
     * Test if the profile information update form submits correctly.
     *
     * @return void
     */
    public function test_update_profile_information_form_submission(): void
    {
        // Simulate an authenticated user
        $this->actingAs($user = \App\Models\User::factory()->create());

        // Prepare form data for updating profile
        $formData = [
            'name'  => 'Updated Name',
            'email' => 'updatedemail@example.com',
        ];

        // Post request to update the profile information
        $response = $this->post(route('profile.update'), $formData);

        // Assert that the profile update was successful and redirected
        $response->assertRedirect(route('profile.update'));
        $this->assertDatabaseHas('users', [
            'name'  => 'Updated Name',
            'email' => 'updatedemail@example.com',
        ]);
    }

    /**
     * Test if the profile information form displays validation errors for invalid data.
     *
     * @return void
     */
    public function test_update_profile_information_validation_errors(): void
    {
        // Simulate an authenticated user
        $this->actingAs($user = \App\Models\User::factory()->create());

        // Prepare invalid form data (e.g., empty name and email)
        $invalidData = [
            'name'  => '',
            'email' => 'invalid-email',
        ];

        // Post request with invalid data
        $response = $this->post(route('profile.update'), $invalidData);

        // Assert that the validation errors are returned
        $response->assertSessionHasErrors(['name', 'email']);
    }
}
