<?php

namespace Tests\Feature\Student\enrollment-eval;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class evaluatedCoursesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the evaluated courses page loads successfully.
     */
    public function test_evaluated_courses_page_loads(): void
    {
        // Simulate an authenticated user if necessary (replace with actual user details or login)
        $user = \App\Models\User::factory()->create();
        
        // Act as the authenticated user (adjust if you are using specific authentication)
        $response = $this->actingAs($user)->get(route('student.enrollment-eval.evaluated-courses'));

        // Assert that the response is successful
        $response->assertStatus(200);
    }

    /**
     * Test if no evaluated courses message appears when the courses list is empty.
     */
    public function test_no_evaluated_courses_message(): void
    {
        // Simulate an authenticated user
        $user = \App\Models\User::factory()->create();

        // Act as the authenticated user
        $response = $this->actingAs($user)->get(route('student.enrollment-eval.evaluated-courses'));

        // Assert that the message "No evaluated courses available" is displayed when there are no courses
        $response->assertSee('No evaluated courses available.');
    }
}
