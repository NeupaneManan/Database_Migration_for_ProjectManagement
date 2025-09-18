<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Meeting extends Model
{
    protected $primaryKey = 'meeting_id';

    protected $fillable = [
        'title', 'agenda', 'organizer_id', 'project_id',
        'meeting_type', 'for_all', 'start_at',
        'duration_minutes', 'location_or_link',
    ];

    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'organizer_id', 'user_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'meeting_participants', 'meeting_id', 'user_id')
                    ->withPivot('status', 'notified_at')
                    ->withTimestamps();
    }
}
