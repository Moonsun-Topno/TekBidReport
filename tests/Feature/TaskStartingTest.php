<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class TaskStartingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_users_can_start_tasks()
    {
        // Fetch existing users
        $user = User::first();
        Auth::login($user);
        $task = Task::factory()->create();

        $response = $this->post(route('task.start', $task->id));

        $response->assertRedirect(route('task.today'));
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'task_owner' => $user->id,
            'task_started' => now()->format('Y-m-d H:i:s'),
        ]);
    }
}
