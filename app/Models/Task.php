<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    protected $primaryKey = 'task_id';

    protected $fillable = [
        'project_id', 'title', 'description', 'assigned_by', 'assigned_to',
        'priority', 'status', 'due_date', 'started_at', 'finished_at',
        'github_link', 'file_path',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }

    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by', 'user_id');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to', 'user_id');
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(TaskSubmission::class, 'task_id', 'task_id');
    }
}
