<?php

namespace Tests\Feature\Registrar;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class registrar-navbarTest extends TestCase
{
    /**
     * Test if the registrar sidebar is displayed.
     *
     * @return void
     */
    public function test_sidebar_is_rendered()
    {
        // Visit the registrar dashboard route
        $response = $this->get(route('registrar.dashboard'));

        // Check if the sidebar exists in the response view
        $response->assertSee('<aside', false); // Check for the opening <aside> tag
        $response->assertSee('CvSU-B'); // Check if the logo exists
    }

    /**
     * Test the navigation links inside the sidebar.
     *
     * @return void
     */
    public function test_sidebar_links()
    {
        // Test Dashboard link
        $response = $this->get(route('registrar.dashboard'));
        $response->assertSee('Dashboard');
        $response->assertStatus(200);

        // Test Enrollment List link
        $response = $this->get(route('registrar.enrollment-lists'));
        $response->assertSee('Enrollment List');
        $response->assertStatus(200);

        // Test Enrolled Students link
        $response = $this->get(route('registrar.enrolled-students'));
        $response->assertSee('Enrolled Students');
        $response->assertStatus(200);

        // Test Student's Record link
        $response = $this->get(route('registrar.students-record'));
        $response->assertSee("Student's Record");
        $response->assertStatus(200);
    }

    /**
     * Test if the active menu item highlights correctly.
     *
     * @return void
     */
    public function test_active_menu_item_highlight()
    {
        // Test if Dashboard menu item is active
        $response = $this->get(route('registrar.dashboard'));
        $response->assertSee('bg-[#4F9A85]'); // Check if the background color for Dashboard is active

        // Test if Enrollment List menu item is active
        $response = $this->get(route('registrar.enrollment-lists'));
        $response->assertSee('bg-[#4F9A85]'); // Check if the background color for Enrollment List is active
    }
}
