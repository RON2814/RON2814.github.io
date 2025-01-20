<?php

namespace Tests\Feature\Student\Checklist;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Student;
use App\Models\Course; // Assuming you have models for the courses

class StudentChecklistTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test if the student checklist page loads correctly.
     */
    public function test_student_checklist_page_loads(): void
    {
        // Create a student record (you may need to adjust this based on your database structure)
        $student = Student::factory()->create([
            'student_number' => '12345678',
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        // Create some courses and add them to the checklist for the student
        $course = Course::factory()->create([
            'course_code' => 'CS101',
            'course_title' => 'Introduction to Computer Science',
            'credit_unit_lecture' => 3,
            'credit_unit_laboratory' => 1,
            'contact_hours_lecture' => 48,
            'contact_hours_laboratory' => 16,
        ]);

        // Assuming you have a pivot or relationship to link the student with courses
        $student->courses()->attach($course, [
            'year' => 'First Year',
            'semester' => 'First Semester',
            'grade' => 'A',
        ]);

        // Make a GET request to the student checklist route (adjust the URL if needed)
        $response = $this->get(route('student.checklist', ['student' => $student->id]));

        // Check if the page loads correctly (status 200)
        $response->assertStatus(200);

        // Verify that the student number and name appear on the page
        $response->assertSee($student->student_number);
        $response->assertSee($student->first_name);
        $response->assertSee($student->last_name);

        // Verify that the course details are displayed on the page
        $response->assertSee($course->course_code);
        $response->assertSee($course->course_title);

        // Verify that the grade is shown in the table
        $response->assertSee('A');
    }

    /**
     * Test if missing grades request link is visible.
     */
    public function test_request_missing_grades_link(): void
    {
        // Create a student record (adjust this as needed)
        $student = Student::factory()->create();

        // Make a GET request to the student checklist route (adjust the URL if needed)
        $response = $this->get(route('student.checklist', ['student' => $student->id]));

        // Ensure the "Request for Missing Grades" link is visible
        $response->assertSee('Request for Missing Grades');
    }
}
