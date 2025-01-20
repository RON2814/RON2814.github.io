<?php

namespace Tests\Feature\Student;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class studentInformationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the student information page loads correctly.
     *
     * @return void
     */
    public function test_student_information_page_loads(): void
    {
        // Create a student instance
        $student = Student::factory()->create();

        // Visit the student information page
        $response = $this->get(route('student.student-information', ['student' => $student->id]));

        // Assert that the page loads successfully
        $response->assertStatus(200);

        // Assert that the student information is displayed correctly on the page
        $response->assertSee($student->student_number);
        $response->assertSee(strtoupper($student->last_name));
        $response->assertSee(strtoupper($student->first_name));
        $response->assertSee(strtoupper($student->middle_name));
        $response->assertSee(strtoupper($student->program->title ?? ''));
        $response->assertSee(strtoupper($student->major ?? 'N/A'));
    }
}
