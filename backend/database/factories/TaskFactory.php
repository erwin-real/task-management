<?php

namespace Database\Factories;

use App\Models\User;
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
    public function definition(): array
    {
        $statuses = ['pending', 'completed'];
        $priorities = ['low', 'medium', 'high'];

        return [
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraph(),
            'user_id' => User::factory(),
            'order' => rand(0, 10),
            'status' => $statuses[rand(0, 1)],
            'priority' => $priorities[rand(0, 2)]
        ];
    }
}
