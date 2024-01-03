<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DesignNamemodel extends Model
{
    protected $table = 'design_name';

    protected $fillable = [
        'name',
        'status',
        'created_at',
        'updated_at',
        'is_delete'
    ];
}
