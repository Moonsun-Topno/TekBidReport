<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $existingUserIds = User::pluck('id')->toArray();

        // Ensure we have at least one user in the database
        if (empty($existingUserIds)) {
            throw new \Exception('No users found in the database.');
        }

        // Randomly select one user ID
        $ownerId = $this->faker->randomElement($existingUserIds);

        // Generate a random timestamp for when the task was started
        $taskStarted = $this->faker->dateTimeBetween('-1 week', 'now');

        // Generate a random timestamp for when the task was completed, which must be after taskStarted
        $taskCompleted = $this->faker->optional()->dateTimeBetween($taskStarted ?? 'now', '+1 week');

        // Calculate the time difference in seconds
        $startedAt = Carbon::parse($taskStarted);
        $completedAt = Carbon::parse($taskCompleted);
        $totalSeconds = $startedAt->diffInSeconds($completedAt);

        // Calculate days, hours, minutes, and seconds
        $days = intdiv($totalSeconds, 86400); // 86400 seconds in a day
        $hours = intdiv($totalSeconds % 86400, 3600); // 3600 seconds in an hour
        $minutes = intdiv(($totalSeconds % 86400) % 3600, 60); // 60 seconds in a minute
        $seconds = ($totalSeconds % 86400) % 3600 % 60;

        // Format the time occupied
        $formattedTimeOccupied = sprintf(
            '%d:%02d:%02d:%02d',
            $days,
            $hours,
            $minutes,
            $seconds
        );

        return [
            'date' => $this->faker->date(),
            'owner_id' => $ownerId, // Use an existing user ID
            'type' => $this->faker->word(),
            'case_type' => $this->faker->word(),
            'region' => $this->faker->word(),
            'customer' => $this->faker->name(),
            'reference_number' => $this->faker->unique()->word(),
            'task_started' => $taskStarted,
            'task_completed' => $taskCompleted,
            'time_occupied' => $formattedTimeOccupied, // Format time occupied as days:HH:MM:SS
            'comments' => $this->faker->optional()->paragraph(),
            //
        ];
    }
}
