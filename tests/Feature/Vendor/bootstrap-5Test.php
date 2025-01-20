<?php

namespace Tests\Feature\Vendor;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Bootstrap5Test extends TestCase
{
    /**
     * Test pagination rendering on the homepage.
     */
    public function test_pagination_rendered(): void
    {
        // Simulate a request to the homepage
        $response = $this->get('/');

        // Check if the response status is OK (200)
        $response->assertStatus(200);

        // Check if pagination exists in the rendered page (based on 'page-link' class)
        $response->assertSee('<ul class="pagination">', false);

        // Check for the presence of the Previous and Next buttons
        $response->assertSee('@lang(\'pagination.previous\')', false);  // Previous button
        $response->assertSee('@lang(\'pagination.next\')', false);      // Next button

        // Check the mobile view (based on 'd-sm-none' and 'd-flex')
        $response->assertSee('d-sm-none', false);
        $response->assertSee('d-flex', false);

        // Check the desktop view (based on 'd-none' and 'd-sm-flex')
        $response->assertSee('d-none', false);
        $response->assertSee('d-sm-flex', false);
    }
}
