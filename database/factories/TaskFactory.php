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
    public function definition(): array
    {
        return [
            'date' => fake()->dateTimeBetween('now', '+1 year'),
            'owner_id' => 1,
            'type' => fake()->sentence(),
            'case_type' => fake()->sentence(),
            'region' => fake()->sentence(),
            'customer' => fake()->sentence(),
            'reference_number' => fake()->sentence(),
            'task_started' => time(),
            //
        ];
    }
}
