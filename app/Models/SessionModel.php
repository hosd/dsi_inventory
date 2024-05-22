<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionModel extends Model
{
    protected $table = 'user_sessions'; // Adjust table name as needed

    protected $fillable = [
        'user_id', 'session_id'
    ];
}
