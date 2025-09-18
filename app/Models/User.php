<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id'; // adjust if your PK is 'id'

    protected $fillable = [
        'name', 'email', 'password', 'id_no', 'address', 'gender',
        'dob', 'contact_no', 'profile_picture', 'status',
        'blood_group', 'id_image', 'role_id',
    ];

   

    public function role()
    {
        return $this->belongsTo(Roles::class, 'role_id', 'role_id');
    }

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class, 'user_specializations', 'user_id', 'specialization_id');
    }

    public function skills()
    {
        return $this->belongsToMany(Skills::class, 'user_skills', 'user_id', 'skill_id');
    }

    public function managedProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'pm_id', 'user_id');
    }

    public function createdProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'created_by', 'user_id');
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_user', 'user_id', 'project_id')
                    ->withPivot('role_in_project', 'assigned_at')
                    ->withTimestamps();
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'assigned_to', 'user_id');
    }

    public function taskSubmissions(): HasMany
    {
        return $this->hasMany(TaskSubmission::class, 'user_id', 'user_id');
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class, 'user_id', 'user_id');
    }

    public function organizedMeetings(): HasMany
    {
        return $this->hasMany(Meeting::class, 'organizer_id', 'user_id');
    }

    public function meetingParticipations(): BelongsToMany
    {
        return $this->belongsToMany(Meeting::class, 'meeting_participants', 'user_id', 'meeting_id')
                    ->withPivot('status', 'notified_at')
                    ->withTimestamps();
    }
}
