<?php

namespace Tests\Feature\Student;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class student-navbarTest extends TestCase
{
    /**
     * Test if the student-navbar renders correctly and routes are accessible.
     */
    public function test_navbar_routes(): void
    {
        // Test the Dashboard link
        $response = $this->get(route('student.dashboard'));
        $response->assertStatus(200);

        // Test the Student Information link
        $response = $this->get(route('student.student-information'));
        $response->assertStatus(200);

        // Test the Student Grades link
        $response = $this->get(route('student.student-grades'));
        $response->assertStatus(200);

        // Test the Enrollment Module link
        $response = $this->get(route('student.enrollment'));
        $response->assertStatus(200);
    }
}
