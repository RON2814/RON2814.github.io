<?php

namespace Tests\Feature\Routes;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the admin dashboard route.
     */
    public function test_admin_dashboard_accessible_to_admin()
    {
        $admin = User::factory()->create([
            'role' => 'admin', // Ensure this matches your role logic
        ]);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertStatus(200); // Admin should be able to access dashboard
    }

    /**
     * Test the student management route is accessible to admin.
     */
    public function test_manage_students_accessible_to_admin()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.manageUsers.student'));

        $response->assertStatus(200); // Admin should be able to manage students
    }

    /**
     * Test that non-admin users are denied access to the admin routes.
     */
    public function test_non_admin_cannot_access_admin_routes()
    {
        $user = User::factory()->create([
            'role' => 'user', // Non-admin user role
        ]);

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertStatus(403); // Non-admin should be denied access
    }

    /**
     * Test that guest users are redirected to login page.
     */
    public function test_guest_user_redirected_to_login()
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('login')); // Guest should be redirected to login
    }

    /**
     * Test admin student store route.
     */
    public function test_store_student()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $studentData = [
            'name' => 'John Doe',
            'student_number' => '12345',
            'email' => 'john@example.com',
        ];

        $response = $this->actingAs($admin)->post(route('admin.manageUsers.store-student'), $studentData);

        $response->assertStatus(200); // Should return 200 or another appropriate status based on your controller response
    }
}
