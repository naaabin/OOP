<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;

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

        $taskIds = Task::all()->pluck('task_id')->toArray();
        return [
       
            'task_id' => $this->faker->randomElement($taskIds),
            'file_name' => $this->faker->word . '.jpg', // Example: "1.jpg", "2.jpg", etc.
            'file_loc' => 'uploads/' . $this->faker->word . '.jpg', // Example: "uploads/1.jpg", "uploads/2.jpg", etc.
        ];
    }
}

