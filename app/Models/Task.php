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

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
