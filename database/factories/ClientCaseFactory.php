<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClientCase>
 */
class ClientCaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        "case_title" => fake()->word(),
        "case_category" => fake()->sentence(),
        "case_status" => fake()->randomElement(['Won','Lose','Ongoing']),
        "case_description" => fake()->sentence(),
        "case_attorney" => fake()->name(),
        "case_date" => fake()->dateTimeBetween('-1 years'),
    ];
}

}
