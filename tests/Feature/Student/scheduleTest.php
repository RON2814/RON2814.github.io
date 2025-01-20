<?php

namespace Tests\Feature\Student;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class scheduleTest extends TestCase
{
    /**
     * Test the schedule page.
     */
    public function test_schedule_page_is_accessible(): void
    {
        // Visit the schedule page route
        $response = $this->get(route('schedule')); // Assuming 'schedule' is the named route for the schedule page

        // Assert the status is 200 (OK)
        $response->assertStatus(200);

        // Check if the schedule table is present
        $response->assertSee('<table', false); // Asserts the table is rendered

        // You can also check for specific elements in the schedule
        $response->assertSee('Mon'); // Check if Monday column exists
        $response->assertSee('GNED 08'); // Check if a class is displayed in the schedule
        $response->assertSee('COSC 80'); // Check if another class appears
        $response->assertSee('DCIT 25'); // Check for the existence of another class

        // Optionally, check if the user is logged in (if the schedule is restricted to logged-in users)
        $this->actingAsUser(); // Ensure a user is logged in for the test
    }

    /**
     * Helper method to log in a user.
     */
    private function actingAsUser()
    {
        $user = User::factory()->create(); // Assuming you have a User factory
        $this->actingAs($user);
    }
}
