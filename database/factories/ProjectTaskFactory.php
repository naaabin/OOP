<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;
use App\Models\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectTask>
 */
class ProjectTaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $taskids = Task::all()->pluck('task_id')->toArray();
        $projectids = Project::all()->pluck('project_id')->toArray();
        return [
           'task_id' => $this->faker->randomElement($taskids),
           'Project_id' => $this->faker->randomElement($projectids),

        ];
    }
}
