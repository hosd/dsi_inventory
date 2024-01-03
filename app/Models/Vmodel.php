<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vmodel extends Model
{
    use HasFactory;use HasFactory,Notifiable;
    
    protected $table = 'model';

    protected $fillable = [
        'name',  
        'makeID', 
        'status',
        'created_at',
        'updated_at',
        'is_delete'
    ];
}
