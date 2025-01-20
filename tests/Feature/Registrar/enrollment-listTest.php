<?php

namespace Tests\Feature\Registrar;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User; // Assuming you have a User model for authentication
use App\Models\Student; // Assuming you have a Student model for your student data

class EnrollmentListTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the enrollment list page loads successfully.
     *
     * @return void
     */
    public function test_enrollment_list_page_is_accessible()
    {
        $user = User::factory()->create(); // Create a user to authenticate (assuming you have a User factory)
        
        $this->actingAs($user) // Simulate authentication
            ->get(route('admin.enrollment-list')) // Replace with the actual route
            ->assertStatus(200) // Check if the page loads successfully
            ->assertSee('Enrollment List'); // Check if the page contains the Enrollment List text
    }

    /**
     * Test filtering functionality by year level.
     *
     * @return void
     */
    public function test_filter_by_year_level()
    {
        $user = User::factory()->create();
        $student = Student::factory()->create(['year_level' => 2]); // Create a student for the test

        $this->actingAs($user)
            ->get(route('admin.enrollment-list', ['year_level' => 2])) // Add filter parameter
            ->assertStatus(200)
            ->assertSee($student->student_number); // Check if the student is displayed
            ->assertSee('2nd Year'); // Check if the correct year level is displayed
    }

    /**
     * Test searching functionality.
     *
     * @return void
     */
    public function test_search_students_by_name_or_student_number()
    {
        $user = User::factory()->create();
        $student = Student::factory()->create(['student_number' => '123456', 'first_name' => 'John']);

        $this->actingAs($user)
            ->get(route('admin.enrollment-list', ['search' => 'John'])) // Search for the student
            ->assertStatus(200)
            ->assertSee($student->student_number) // Check if the student is found
            ->assertSee($student->first_name); // Check if the student's name appears
    }

    /**
     * Test the filtering functionality by program.
     *
     * @return void
     */
    public function test_filter_by_program()
    {
        $user = User::factory()->create();
        $student = Student::factory()->create(['program_id' => 1]); // Assuming program_id 1 corresponds to Computer Science

        $this->actingAs($user)
            ->get(route('admin.enrollment-list', ['program_id' => 1])) // Filter by program
            ->assertStatus(200)
            ->assertSee($student->student_number)
            ->assertSee('Computer Science'); // Verify that the student's program is displayed correctly
    }

    /**
     * Test enrollment functionality (button click simulation).
     *
     * @return void
     */
    public function test_enroll_student_button_works()
    {
        $user = User::factory()->create();
        $student = Student::factory()->create();

        $this->actingAs($user)
            ->post(route('admin.enroll-student', ['student_number' => $student->student_number])) // Assuming a route for enrolling students
            ->assertStatus(200)
            ->assertSee('Student enrolled successfully'); // Verify if the success message is displayed
    }

    /**
     * Test if the table displays no students when none are available.
     *
     * @return void
     */
    public function test_no_students_found()
    {
        $user = User::factory()->create(); 

        $this->actingAs($user)
            ->get(route('admin.enrollment-list'))
            ->assertStatus(200)
            ->assertSee('No students found'); // Assuming this message is shown when no students are available
    }
}
