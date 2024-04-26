<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'task' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'priority' => $this->faker->randomElement(['Yes', 'No']),
            // Add other relevant attributes
        ];
    }
}
