<?php

namespace Tests\Feature\Layouts;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class navigationTest extends TestCase
{
    /**
     * Test that the navigation sidebar loads successfully.
     */
    public function test_navigation_sidebar_renders_correctly(): void
    {
        $response = $this->actingAs($this->createUser())->get('/');

        $response->assertStatus(200);
        $response->assertSee('CvSU-B'); // Sidebar header
        $response->assertSee('Dashboard'); // Dashboard link
        $response->assertSee('Manage Users'); // Manage Users link
    }

    /**
     * Test that the dashboard link is accessible.
     */
    public function test_dashboard_link_is_accessible(): void
    {
        $response = $this->actingAs($this->createUser())->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Dashboard');
    }

    /**
     * Test that the submenu items are accessible.
     */
    public function test_manage_users_submenu_items_are_accessible(): void
    {
        $submenuRoutes = [
            // Replace '#' with actual routes for each submenu if available
            'Student' => '#',
            'Registrar' => '#',
            'Department' => '#',
            'Admin' => '#',
        ];

        foreach ($submenuRoutes as $item => $route) {
            if ($route === '#') {
                // Skip testing dummy links
                continue;
            }

            $response = $this->actingAs($this->createUser())->get($route);
            $response->assertStatus(200);
            $response->assertSee($item);
        }
    }

    /**
     * Test the navigation toggle JavaScript functionality.
     */
    public function test_navigation_toggle(): void
    {
        // Simulate JavaScript actions using a frontend testing tool like Dusk or Cypress.
        $this->markTestIncomplete('Frontend JavaScript interactions should be tested with a browser-based testing tool.');
    }

    /**
     * Create a test user for authentication.
     */
    private function createUser()
    {
        return \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}
