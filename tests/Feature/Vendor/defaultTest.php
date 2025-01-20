<?php

namespace Tests\Feature\Vendor;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DefaultTest extends TestCase
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

        // Check if pagination exists in the rendered page (based on 'pagination' class)
        $response->assertSee('<ul class="pagination">', false);

        // Check for the presence of the Previous and Next buttons
        $response->assertSee('&lsaquo;', false);  // Previous button
        $response->assertSee('&rsaquo;', false);  // Next button

        // Check if the current page is marked as active
        $response->assertSee('class="active"', false);
    }
}
