<?php

namespace Tests\Feature\Registrar;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentsRecordTest extends TestCase
{
    /**
     * Test the students record page loads successfully.
     */
    public function test_students_record_page_loads(): void
    {
        $response = $this->get(route('registrar.students-record')); // Update with the actual route name

        $response->assertStatus(200);
        $response->assertViewIs('registrar.students-record'); // Ensure the correct view is returned
    }

    /**
     * Test filtering by year level.
     */
    public function test_filter_by_year_level(): void
    {
        $response = $this->get(route('registrar.students-record') . '?yearLevel=1');

        $response->assertStatus(200);
        $response->assertSee('1st Year'); // You can adjust this based on the data you're displaying
    }

    /**
     * Test filtering by section.
     */
    public function test_filter_by_section(): void
    {
        $response = $this->get(route('registrar.students-record') . '?section=A');

        $response->assertStatus(200);
        $response->assertSee('Section A'); // Ensure the section is being filtered
    }

    /**
     * Test the student search functionality.
     */
    public function test_search_students(): void
    {
        $response = $this->get(route('registrar.students-record') . '?search=John Doe');

        $response->assertStatus(200);
        $response->assertSee('John Doe'); // Verify that the student is found
    }

    /**
     * Test if the page includes the necessary elements (like table headings).
     */
    public function test_page_contains_student_table(): void
    {
        $response = $this->get(route('registrar.students-record'));

        $response->assertStatus(200);
        $response->assertSee('Student #');
        $response->assertSee('Student Name');
        $response->assertSee('Program');
        $response->assertSee('Year');
        $response->assertSee('Section');
    }

    // You can add more specific tests depending on the functionality you need to validate.
}
