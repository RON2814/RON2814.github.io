<?php

namespace Tests\Feature\Student\EnrollmentEval;

use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the cor.blade.php page loads correctly.
     *
     * @return void
     */
    public function test_cor_page_loads_correctly()
    {
        // Create a student, enrollment, and courses to be used in the test
        $student = Student::factory()->create();
        $enrollment = Enrollment::factory()->create(['student_id' => $student->id]);
        $courses = Course::factory()->count(3)->create();

        // Associate the student with courses for the test
        $student->courses()->attach($courses);

        // Send a GET request to the route that renders the cor.blade.php view
        $response = $this->get(route('student.enrollment.cor', ['student' => $student->id]));

        // Assert the response status is 200 (OK)
        $response->assertStatus(200);

        // Check if specific content is present in the response (e.g., student name, registration form title)
        $response->assertSee($student->last_name);
        $response->assertSee('REGISTRATION FORM');
        $response->assertSee($enrollment->school_year_start);
        $response->assertSee($courses[0]->course_code);

        // Optionally check if a specific view is rendered
        $response->assertViewIs('cor');
    }
}
