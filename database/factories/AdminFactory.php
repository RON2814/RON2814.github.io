<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Roles\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "first_name" => $this->faker->firstName(),
            "last_name" => $this->faker->lastName(),
            "middle_name" => $this->faker->lastName(),
            "email" => $this->faker->unique()->safeEmail(),
            "contact_number" => $this->faker->phoneNumber(),
        ];
    }
}
