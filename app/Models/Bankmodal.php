<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Bankmodal extends Model
{
    use HasFactory,Notifiable;
    
    protected $table = 'bank';

    protected $fillable = [
        'name',
        'vlogo',
        'status',
        'created_at',
        'updated_at'
    ];
}
