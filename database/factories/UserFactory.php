<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        // Randomly select a gender (male, female, or other)
        $gender = $this->faker->randomElement(['male', 'female', 'other']);

        return [
            'name' => $this->faker->firstName($gender),
            'email' => $this->faker->unique()->safeEmail(),
            'gender' => $gender,
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
