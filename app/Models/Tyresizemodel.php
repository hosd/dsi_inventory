<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tyresizemodel extends Model
{
    protected $table = 'tyre_size';

    protected $fillable = [
        'width',
        'profile',
        'rim',
        'status',
        'created_at',
        'updated_at',
        'is_delete'
    ];
    
}
