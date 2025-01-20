<?php

namespace Tests\Feature\Student;

use App\Models\User;
use App\Models\Course; // Include your course model if needed
use App\Models\Checklist; // Include your checklist model if needed
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentGradesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the student grades page is accessible.
     */
    public function test_student_grades_page_is_accessible(): void
    {
        // Create a user (ensure this user has the proper role or attributes for access)
        $user = User::factory()->create();

        // Simulate login as the created user
        $response = $this->actingAs($user)->get(route('student.student-grades'));

        // Assert that the response status is 200 (successful)
        $response->assertStatus(200);

        // Optionally, you can check if specific content appears in the page, like the header
        $response->assertSee('Grades Management');
        $response->assertSee('Display Grades');
    }

    /**
     * Test if grades are displayed correctly on the page.
     */
    public function test_student_grades_display(): void
    {
        // Create a user and associate with a checklist
        $user = User::factory()->create();
        $course = Course::factory()->create();
        $checklist = Checklist::factory()->create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'grade' => '1.00',
            'instructor_id' => 1, // Assuming instructor is a valid id
        ]);

        // Simulate login as the created user
        $response = $this->actingAs($user)->get(route('student.student-grades'));

        // Assert that the response status is 200 (successful)
        $response->assertStatus(200);

        // Check if the course grade appears in the page
        $response->assertSee($course->course_code);
        $response->assertSee($course->course_title);
        $response->assertSee('1.00'); // Assert the grade is visible
    }
}
