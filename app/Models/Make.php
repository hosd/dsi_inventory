<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Make extends Model
{
    use HasFactory;use HasFactory,Notifiable;
    
    protected $table = 'make';

    protected $fillable = [
        'name',
        'status',
        'created_at',
        'updated_at',
        'is_delete'
    ];
}
