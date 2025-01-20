<?php

namespace Tests\Feature\Registrar;

use App\Models\Student;
use App\Models\Program;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnrolledStudentsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the Enrolled Students page loads successfully.
     *
     * @return void
     */
    public function test_enrolled_students_page_loads()
    {
        $response = $this->get(route('admin.enrolled-students'));

        $response->assertStatus(200);
        $response->assertSee('Enrolled Students');
    }

    /**
     * Test the student filter functionality.
     *
     * @return void
     */
    public function test_filter_by_year_level()
    {
        // Create sample students and a program
        $program = Program::create(['title' => 'Computer Science']);
        $student1 = Student::create([
            'student_number' => 'S001',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'middle_name' => 'M',
            'program_id' => $program->id,
            'classification' => 'Freshman',
            'year_level' => 1,
            'section' => 'A',
            'semester' => '2025-1',
        ]);
        
        // Get response with filter applied
        $response = $this->get(route('admin.enrolled-students', ['year_level' => 1]));

        $response->assertStatus(200);
        $response->assertSee($student1->student_number);
    }

    /**
     * Test the search functionality.
     *
     * @return void
     */
    public function test_search_students_by_name_or_number()
    {
        // Create a sample student
        $program = Program::create(['title' => 'Computer Science']);
        $student = Student::create([
            'student_number' => 'S001',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'middle_name' => 'M',
            'program_id' => $program->id,
            'classification' => 'Freshman',
            'year_level' => 1,
            'section' => 'A',
            'semester' => '2025-1',
        ]);
        
        // Test searching by student number
        $response = $this->get(route('admin.enrolled-students', ['search' => 'S001']));
        $response->assertStatus(200);
        $response->assertSee($student->student_number);

        // Test searching by student name
        $response = $this->get(route('admin.enrolled-students', ['search' => 'John Doe']));
        $response->assertStatus(200);
        $response->assertSee($student->first_name);
    }

    /**
     * Test if students are listed correctly.
     *
     * @return void
     */
    public function test_students_are_displayed()
    {
        // Create a sample student
        $program = Program::create(['title' => 'Computer Science']);
        $student = Student::create([
            'student_number' => '',
            'first_name' => '',
            'last_name' => '',
            'middle_name' => '',
            'program_id' => $program->id,
            'classification' => 'Freshman',
            'year_level' => 1,
            'section' => 'A',
            'semester' => '2025-1',
        ]);

        // Get response for the enrolled students page
        $response = $this->get(route('admin.enrolled-students'));

        $response->assertStatus(200);
        $response->assertSee($student->student_number);
        $response->assertSee($student->first_name);
        $response->assertSee($student->last_name);
    }
}
