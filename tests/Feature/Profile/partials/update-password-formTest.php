<?php

namespace Tests\Feature\Profile\partials;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class update-password-formTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the update password form view is accessible.
     */
    public function test_update_password_form_is_accessible(): void
    {
        // Assuming you are logged in and trying to visit the password update page.
        $response = $this->actingAs(User::factory()->create())->get(route('password.update'));

        // Assert that the status is OK (200) and the form is being displayed
        $response->assertStatus(200);
        $response->assertSee('Update Password');
    }

    /**
     * Test form submission with valid data.
     */
    public function test_update_password_with_valid_data(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('old-password'),
        ]);

        $response = $this->actingAs($user)->put(route('password.update'), [
            'current_password' => 'old-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $response->assertRedirect(route('profile.show')); // Assuming redirect after update
        $this->assertTrue(\Hash::check('new-password', $user->fresh()->password));
    }

    /**
     * Test form submission with invalid data.
     */
    public function test_update_password_with_invalid_data(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('old-password'),
        ]);

        $response = $this->actingAs($user)->put(route('password.update'), [
            'current_password' => 'wrong-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $response->assertSessionHasErrors('current_password');
    }
}
