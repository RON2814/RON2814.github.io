<?php

namespace Tests\Feature\Student;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class dashboardTest extends TestCase
{
    /**
     * Test if the dashboard page is loading properly.
     *
     * @return void
     */
    public function test_dashboard_page_loads(): void
    {
        // Simulate a logged-in student or set necessary data for the student
        $student = \App\Models\Student::factory()->create(); // Adjust based on your student model and factory

        // Act: Send a GET request to the dashboard route (adjust the URL if necessary)
        $response = $this->actingAs($student)->get('/student/dashboard'); // Adjust URL as per your route

        // Assert: Check if the status is 200 (OK) and that content includes expected strings
        $response->assertStatus(200);
        $response->assertSee($student->student_number); // Ensure student number is displayed
        $response->assertSee($student->last_name);      // Ensure student's last name is displayed
        $response->assertSee($student->first_name);     // Ensure student's first name is displayed
        $response->assertSee('TRUTH');                  // Ensure the "TRUTH" word is in the content
        $response->assertSee('EXCELLENCE');             // Ensure the "EXCELLENCE" word is in the content
        $response->assertSee('SERVICE');                // Ensure the "SERVICE" word is in the content
    }
}
