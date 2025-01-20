<?php

namespace Database\Factories;

use App\Models\Roles\Student;
use App\Models\Address;
use App\Models\Program;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Roles\Student>
 */
class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "student_number" => User::factory()->create()->id,
            "first_name" => fake()->firstName(),
            "last_name" => fake()->lastName(),
            "middle_name" => fake()->lastName(),
            "extension_name" => fake()->optional()->randomElement(['Jr.', 'Sr.', 'III', null]),
            "contact_number" => fake()->phoneNumber(),
            "birthday" => fake()->date(),
            "sex" => fake()->randomElement(['male', 'female', 'other']),

            // Assuming program_id references an existing program
            "program_id" => Program::exists() ? Program::inRandomOrder()->first()->id : 1,

            "classification" => fake()->randomElement(['regular', 'irregular', 'transferee', 'returnee']),

            // Assumes AddressFactory exists; creates an address if not
            "address_id" => Address::factory()->create()->id,
        ];
    }
}
