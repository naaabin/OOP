<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'file_id' => $this->faker->unique()->numberBetween(173, 250),
            'task_id' => $this->faker->numberBetween(86, 106),
            'file_name' => $this->faker->word . '.jpg', // Example: "1.jpg", "2.jpg", etc.
            'file_loc' => 'uploads/' . $this->faker->word . '.jpg', // Example: "uploads/1.jpg", "uploads/2.jpg", etc.
        ];
    }
}
