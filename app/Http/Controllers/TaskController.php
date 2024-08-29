<?php

namespace App\Http\Controllers;

use Carbon\carbon;
use App\Models\Task;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Task::with('owner');
        
        //paginate the results
        $tasks = $query
            ->paginate(15)->onEachSide(1);

        return inertia("Task/Index", [
            "tasks" => TaskResource::collection($tasks),

        ]);
        //
    }

    public function today()
    {
        $today = now()->startOfDay();
        $query = Task::with('owner');
        
        //paginate the results
        $tasks = $query->whereDate('date', $today)
            ->paginate(10)->onEachSide(1);

        return inertia("Task/Today", [
            "tasks" => TaskResource::collection($tasks),

        ]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia("Task/Create");
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated(); 
        $data['owner_id'] = Auth::id();
        $data['date'] = now()->toDateString();
        Task::create($data);
            

        return to_route('task.today');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return inertia('Task/Edit',[
            'task' => new TaskResource($task),
        ]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $data = $request->validated();
        $data['task_completed'] = now();
        
        //$createdAt = $task->created_at; //accessing the timestamp
        //$completedAt = $data['task_completed']; 

        $startedAt = Carbon::parse($task->task_started);
        $completedAt = Carbon::parse($data['task_completed']);

        //getting the difference
        // Calculate the difference in total seconds
    $totalSeconds = $startedAt->diffInSeconds($completedAt);

    // Calculate days, hours, minutes, and seconds
    $days = intdiv($totalSeconds, 86400); // 86400 seconds in a day
    $hours = intdiv($totalSeconds % 86400, 3600); // 3600 seconds in an hour
    $minutes = intdiv(($totalSeconds % 86400) % 3600, 60); // 60 seconds in a minute
    $seconds = ($totalSeconds % 86400) % 3600 % 60;


        //formatting in days:HH:MM:SS
        $formattedTimeOccupied = sprintf(
            '%d:%02d:%02d:%02d',
        $days,
        $hours,
        $minutes,
        $seconds
        );

        $data['time_occupied'] = $formattedTimeOccupied;


        $task->update($data);
        return to_route('task.today');
        //
    }   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }

    public function start(Request $request, Task $task)
    {
        $task->task_started = now();
        $task->save();

        return to_route('task.today');

    }
}
