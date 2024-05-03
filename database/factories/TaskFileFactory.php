<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;
use App\Models\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskFile>
 */
class TaskFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Get all task IDs
        $taskIds = Task::all()->pluck('task_id')->toArray();

        // Get all file IDs
        $fileIds = File::all()->pluck('file_id')->toArray();

        return [
            'task_id' => $this->faker->randomElement($taskIds),
            'file_id' => $this->faker->randomElement($fileIds),
       
        ];
    }
}
