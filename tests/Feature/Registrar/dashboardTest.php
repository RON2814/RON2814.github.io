<?php

namespace Tests\Feature\Registrar;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class dashboardTest extends TestCase
{
    /**
     * Test if the dashboard page loads successfully.
     *
     * @return void
     */
    public function test_dashboard_page_loads_successfully()
    {
        $response = $this->get('/dashboard'); // Adjust the URL path if needed

        $response->assertStatus(200); // Ensure the response is 200 (OK)
        $response->assertSee('Total Students'); // Ensure a specific content is present on the page
        $response->assertSee('Schedule Enrollment for BSCS'); // Ensure the schedule section is visible
    }
}
