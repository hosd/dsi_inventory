<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DealerSessionModel extends Model
{
    protected $table = 'dealer_sessions'; // Adjust table name as needed

    protected $fillable = [
        'dealer_id', 'session_id'
    ];
}
