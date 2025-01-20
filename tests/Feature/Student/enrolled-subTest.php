<?php

namespace Tests\Feature\Student;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class enrolled-subTest extends TestCase
{
    /**
     * A basic feature test example for enrolled-sub page.
     */
    public function test_enrolled_sub_page_is_accessible(): void
    {
        // Make a GET request to the enrolled-sub page
        $response = $this->get('/path-to-enrolled-sub'); // Replace with actual route

        // Assert that the response status is 200
        $response->assertStatus(200);
    }

    /**
     * Test that the enrolled-sub page has specific content.
     */
    public function test_enrolled_sub_page_contains_content(): void
    {
        // Visit the page
        $response = $this->get('/path-to-enrolled-sub'); // Replace with actual route

        // Assert the page contains expected content, such as a specific HTML element or text
        $response->assertSee('Some specific text or element on the page');
    }
}
