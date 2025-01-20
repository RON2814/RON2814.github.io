<?php

namespace Tests\Feature\Routes;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class DepartmentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the department dashboard route.
     *
     * @return void
     */
    public function test_department_dashboard()
    {
        $user = User::factory()->create(); // Assuming you have a user factory
        $user->assignRole('department'); // Ensure the user has the 'department' role

        $response = $this->actingAs($user)->get(route('department.dashboard'));

        $response->assertStatus(200);
        $response->assertViewIs('department.dashboard'); // Assuming your view is named 'department.dashboard'
    }

    /**
     * Test the student evaluation route.
     *
     * @return void
     */
    public function test_student_evaluation()
    {
        $user = User::factory()->create();
        $user->assignRole('department');

        $response = $this->actingAs($user)->get(route('department.student-Evaluation'));

        $response->assertStatus(200);
        $response->assertViewIs('department.student-Evaluation');
    }

    /**
     * Test the courses route.
     *
     * @return void
     */
    public function test_courses()
    {
        $user = User::factory()->create();
        $user->assignRole('department');

        $response = $this->actingAs($user)->get(route('department.courses'));

        $response->assertStatus(200);
        $response->assertViewIs('department.courses');
    }

    /**
     * Test the instructor route.
     *
     * @return void
     */
    public function test_instructor()
    {
        $user = User::factory()->create();
        $user->assignRole('department');

        $response = $this->actingAs($user)->get(route('department.instructor'));

        $response->assertStatus(200);
        $response->assertViewIs('department.instructor');
    }

    /**
     * Test the add instructor route.
     *
     * @return void
     */
    public function test_add_instructor()
    {
        $user = User::factory()->create();
        $user->assignRole('department');

        $response = $this->actingAs($user)->post(route('department.instructor.add-instructor'), [
            // Add any necessary parameters here
        ]);

        $response->assertStatus(302); // Redirect after successful submission
        $response->assertRedirect(route('department.instructor'));
    }

    /**
     * Test the update instructor route.
     *
     * @return void
     */
    public function test_update_instructor()
    {
        $user = User::factory()->create();
        $user->assignRole('department');

        $instructorId = 1; // Assume you have an instructor with ID 1

        $response = $this->actingAs($user)->patch(route('department.instructor.update-instructor', $instructorId), [
            // Add parameters for updating instructor
        ]);

        $response->assertStatus(302); // Redirect after successful update
        $response->assertRedirect(route('department.instructor'));
    }

    /**
     * Test the schedule route.
     *
     * @return void
     */
    public function test_schedule()
    {
        $user = User::factory()->create();
        $user->assignRole('department');

        $response = $this->actingAs($user)->get(route('department.schedule'));

        $response->assertStatus(200);
        $response->assertViewIs('department.schedule');
    }
}
