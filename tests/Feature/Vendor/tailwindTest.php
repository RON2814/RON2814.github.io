<?php

namespace Tests\Feature\Vendor;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class tailwindTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        // Send a GET request to the homepage
        $response = $this->get('/');

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Optional: Check if the page contains specific content related to the pagination
        $response->assertSee('pagination'); // You can replace this with any relevant text/markup from the tailwind pagination
    }
}
