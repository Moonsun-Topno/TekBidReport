<?php

namespace App\Http\Controllers;

use Carbon\carbon;
use App\Models\Task;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\User;
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
        $data['task_started'] = now();
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
        $timeOccupied = $completedAt->diff($startedAt);

        //formatting in days:HH:MM:SS
        $formattedTimeOccupied = sprintf(
            '%d:%02d:%02d:%02d',
            $timeOccupied->days,
            $timeOccupied->h,
            $timeOccupied->i,
            $timeOccupied->s
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
}
