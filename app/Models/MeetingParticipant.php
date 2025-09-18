<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingParticipant extends Model
{
    protected $table = 'meeting_participants';

    protected $fillable = [
        'meeting_id', 'user_id', 'status', 'notified_at',
    ];
}
