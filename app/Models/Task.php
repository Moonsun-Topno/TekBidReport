<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'owner_id',
        'task_owner',
        'type',
        'case_type',
        'region',
        'customer',
        'reference_number',
        'task_started',
        'task_completed',
        'time_occupied',
        'comments',
    ];

    protected $casts = [
        'date' => 'date',
        'task_started' => 'datetime',
        'task_completed' => 'datetime',
    ];

    public function owner() // this is for who added the task
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function taskOwner() //this defines who started the task and is responsible for it
{
    return $this->belongsTo(User::class, 'task_owner');
}
}
