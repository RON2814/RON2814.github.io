<?php

namespace Tests\Feature\Student;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class enrollmentTest extends TestCase
{
    /**
     * Test if the enrollment page is accessible.
     */
    public function test_enrollment_page_is_accessible(): void
    {
        // Assuming the route for enrollment is '/enrollment'
        $response = $this->get('/enrollment');

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);
    }
}
