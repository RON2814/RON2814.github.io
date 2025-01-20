<?php

namespace Tests\Feature\Registrar;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class corTest extends TestCase
{
    /**
     * Test the COR page.
     *
     * @return void
     */
    public function test_cor_page_renders_successfully()
    {
        $response = $this->get('/cor'); // Adjust the URL according to the actual route for this page

        $response->assertStatus(200);
        $response->assertSee('Cavite State University'); // Check for university name
        $response->assertSee('REGISTRATION FORM'); // Check for registration form label
        $response->assertSee('Student Number'); // Check if student number is present
        $response->assertSee('Name'); // Check if student name is displayed
        $response->assertSee('Program'); // Check if program name is displayed
        $response->assertSee('Units'); // Check if units column is displayed in the table
        $response->assertSee('Course Description'); // Check for course description in table
    }
}
