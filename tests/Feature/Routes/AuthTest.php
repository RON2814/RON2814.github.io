<?php

namespace Tests\Feature\Routes;

use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    // Test register route for guest user
    public function test_register_route_for_guest_user()
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200);
    }

    // Test login route for guest user
    public function test_login_route_for_guest_user()
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
    }

    // Test forgot password route for guest user
    public function test_forgot_password_route_for_guest_user()
    {
        $response = $this->get(route('password.request'));
        $response->assertStatus(200);
    }

    // Test reset password route for guest user
    public function test_reset_password_route_for_guest_user()
    {
        $response = $this->get(route('password.reset', ['token' => 'dummy-token']));
        $response->assertStatus(200);
    }

    // Test verify email route for authenticated user
    public function test_verify_email_route_for_authenticated_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('verification.notice'));
        $response->assertStatus(200);
    }

    // Test confirm password route for authenticated user
    public function test_confirm_password_route_for_authenticated_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('password.confirm'));
        $response->assertStatus(200);
    }

    // Test logout route for authenticated user
    public function test_logout_route_for_authenticated_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('logout'));
        $response->assertStatus(302); // Assuming it redirects after logout
    }
}