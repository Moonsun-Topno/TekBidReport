<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a task can be stored in the database.
     *
     * @return void
     */
    public function test_store_task()
    {
        // Create a user and authenticate them
        $user = User::factory()->create();
        Auth::login($user);

        // Define the task data
        $taskData = [
            'type' => 'Task Type',
            'case_type' => 'Case Type',
            'region' => 'Region',
            'customer' => 'Customer Name',
            'reference_number' => 'Ref123',
        ];

        // Send a POST request to the store route
        $response = $this->post(route('task.store'), $taskData);

        // Assert that the response redirects to the expected route
        $response->assertRedirect(route('task.today'));

        // Assert that the task is created in the database
        $this->assertDatabaseHas('tasks', array_merge($taskData, [
            'owner_id' => $user->id,
            'date' => now()->toDateString(),
        ]));
    }

}
