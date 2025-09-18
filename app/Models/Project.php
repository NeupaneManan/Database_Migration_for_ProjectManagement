<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    protected $primaryKey = 'project_id';

    protected $fillable = [
        'title', 'description', 'pm_id', 'created_by',
        'start_date', 'end_date', 'status',
    ];

    public function pm(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pm_id', 'user_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'project_id', 'project_id');
    }

    public function staff(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id')
                    ->withPivot('role_in_project', 'assigned_at')
                    ->withTimestamps();
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class, 'project_id', 'project_id');
    }

    public function meetings(): HasMany
    {
        return $this->hasMany(Meeting::class, 'project_id', 'project_id');
    }
}
