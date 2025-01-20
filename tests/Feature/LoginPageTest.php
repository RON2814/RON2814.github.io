<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class LoginPageTest extends TestCase
{
    /**
     * Test that the login page renders successfully.
     */
    public function test_login_page_loads(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Cavite State University');
        $response->assertSee('Email Address');
        $response->assertSee('Password');
        $response->assertSee('Log In');
        $response->assertSee('Forgot Your Password?');
    }

    /**
     * Test the login form submits correctly.
     */
    public function test_login_form_submission(): void
    {
        // Create a user to test login
        $user = User::factory()->create([
            'email' => 'department@email.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'login' => 'department@email.com',  
            'password' => 'password',           
        ]);

        $response->assertRedirect(route('student.dashboard'));  
    }
}
