<?php

namespace Tests\Feature\Student\enrollment-eval;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class under_reviewTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        // Make a GET request to the page you want to test
        $response = $this->get('/path-to-under-review-page'); // Replace with the correct URL path

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);
    }
}
