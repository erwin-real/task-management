<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        // $statuses = ['pending', 'completed'];
        // $priorities = ['low', 'medium', 'high'];

        // return [
        //     'title' => fake()->jobTitle(),
        //     'description' => fake()->paragraph(),
        //     'user_id' => 1,
        //     // 'user_id' => User::factory(),
        //     'order' => fake()->randomNumber(),
        //     'status' => $statuses[rand(0, 1)],
        //     'priority' => $priorities[rand(0, 2)]
        // ];

        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['pending', 'completed']),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'order' => $this->faker->randomNumber(),
            'user_id' => 1, // Example user ID for testing purposes
        ];

    }
}
