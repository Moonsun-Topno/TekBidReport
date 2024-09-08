<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\carbon;
use Illuminate\Support\Facades\Storage;
Use App\Models\Task;


class TaskResource extends JsonResource
{
    public static $wrap = false;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'id' => $this->id,
        'date' => (new Carbon($this->date))->format
        ('jS - F'),
        'owner_id' => new UserResource($this->whenLoaded('owner')),
        'type' => $this->type,
        'case_type' => $this->case_type,
        'region' => $this->region,
        'customer' => $this->customer,
        'reference_number' => $this->reference_number,
        'created_at' => (new Carbon($this->created_at))->format
        ('h:i A'),
        'task_started' => $this -> task_started ? (new Carbon($this->task_started))->format
        ('h:i A') : $this -> task_started,
        'task_completed' => $this -> task_completed ? (new Carbon($this->task_completed))->format
        ('h:i A') : $this -> task_completed,
        'time_occupied'=> $this -> time_occupied, //$this->time_occupied ? (new Carbon($this->task_occupied))->format
        //('h:i') :
        'comments'=> $this->comments,
        'taskowner' => new UserResource($this->whenLoaded('taskOwner')),
        ];
    }
}
