<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskUser>
 */
class TaskUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $taskids = Task::all()->pluck('task_id')->toArray();
        $Userids = User::all()->pluck('id')->toArray();
        
        return [
            'task_id' => $this->faker->randomElement($taskids),
            'id' => $this->faker->randomElement($Userids),
              
        ];
    }
}
