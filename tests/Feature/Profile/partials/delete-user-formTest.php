<?php

namespace Tests\Feature\Profile\partials;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class delete-user-formTest extends TestCase
{
    /**
     * Test if the delete user form page is accessible.
     *
     * @return void
     */
    public function test_delete_user_form_page_is_accessible()
    {
        $response = $this->get('/profile');  // Adjust URL if necessary to match where the form is located

        $response->assertStatus(200);
        $response->assertSee('Delete Account');  // Verify the 'Delete Account' header is present
    }

    /**
     * Test the delete account form submission.
     *
     * @return void
     */
    public function test_delete_account_submission()
    {
        $user = User::factory()->create();  // Assuming you're using a User factory to create a user for testing

        $this->actingAs($user);  // Log the user in

        $response = $this->post(route('profile.destroy'), [
            'password' => 'user_password',  // Replace with actual password
        ]);

        $response->assertRedirect();  // Redirect after successful deletion
        $this->assertGuest();  // Assert the user is logged out

        // You can also check if the user data was actually deleted from the database
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
