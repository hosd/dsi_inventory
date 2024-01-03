<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAPIActivity extends Model
{
    use HasFactory;
     protected $table = 'log_api_activities';

    protected $fillable = [
        'subject', 'url','method', 'ip', 'user_id', 'status'
    ];
}
