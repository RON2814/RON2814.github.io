<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConsoleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the 'inspire' console command is working correctly.
     */
    public function test_inspire_command(): void
    {
        $this->artisan('inspire')
            ->expectsOutputToContain('“') // Check part of the quote, assuming it starts with a quote mark.
            ->assertExitCode(0); // Ensure the command executes successfully.
    }

    /**
     * Test that the 'list' command is accessible.
     */
    public function test_list_command(): void
    {
        $this->artisan('list')
            ->expectsOutputToContain('help') // Confirm that 'help' appears in the output.
            ->assertExitCode(0); // Ensure the command executes successfully.
    }
}
