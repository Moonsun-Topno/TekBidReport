<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the number of tasks you want to create
        $numberOfTasks = 50;

        // Use the TaskFactory to create the tasks
        Task::factory()->count($numberOfTasks)->create();
        //
    }
}
