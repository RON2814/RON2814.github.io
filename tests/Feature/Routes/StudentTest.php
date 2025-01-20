<?php

namespace Tests\Feature\Routes;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test to check if student routes are working.
     *
     * @return void
     */
    public function test_student_routes()
    {
        // Define the routes you want to test
        $routes = [
            'student.dashboard',
            'student.student-information',
            'student.enrolled-sub',
            'student.schedule',
            'student.student-grades',
            'student.student-checklist',
            'student.enrollment',
            'student.enrollment-eval.evaluated-courses',
            'student.enrollment-eval.under-review',
            'student.enrollment-eval.cor'
        ];

        // Loop through each route and test its status
        foreach ($routes as $route) {
            $response = $this->get(route($route));

            // Assert that each route returns a successful response
            $response->assertStatus(200);
        }
    }
}
