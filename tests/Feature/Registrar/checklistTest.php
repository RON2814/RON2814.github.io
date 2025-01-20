<?php

namespace Tests\Feature\Registrar;

use App\Models\Student;
use App\Models\Checklist;
use App\Models\Program;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class checklistTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the checklist page is accessible and shows student data.
     *
     * @return void
     */
    public function test_checklist_page_renders_correctly()
    {
        // Create a test student and program (replace with actual model relations)
        $program = Program::factory()->create();
        $student = Student::factory()->create([
            'program_id' => $program->id,
        ]);
        
        // Create a checklist for this student (you can modify this based on actual model relationships)
        $checklist = Checklist::factory()->create([
            'student_id' => $student->id,
            'year' => 'First Year',
            'semester' => 'First Semester',
        ]);

        // Make a GET request to the checklist page
        $response = $this->get(route('registrar.checklist', ['student_number' => $student->student_number]));

        // Assert that the page returns a 200 status
        $response->assertStatus(200);

        // Assert that the student's information appears on the page
        $response->assertSee($student->student_number);
        $response->assertSee($student->last_name);
        $response->assertSee($student->first_name);
        $response->assertSee($student->program->title);

        // Assert that the checklist data appears
        $response->assertSee($checklist->course_code); // assuming 'course_code' is part of your checklist data
        $response->assertSee($checklist->semester);
    }

    /**
     * Test if a student with no checklist data doesn't break the page.
     *
     * @return void
     */
    public function test_checklist_page_with_no_data()
    {
        // Create a student with no checklist data
        $student = Student::factory()->create();

        // Make a GET request to the checklist page
        $response = $this->get(route('registrar.checklist', ['student_number' => $student->student_number]));

        // Assert that the page loads correctly without errors
        $response->assertStatus(200);

        // Optionally, check that a message for no checklist data is displayed
        $response->assertSee('No checklist data available'); // customize based on your implementation
    }
}
