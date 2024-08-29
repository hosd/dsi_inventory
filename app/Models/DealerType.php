<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DealerType extends Model
{
    use HasFactory,Notifiable;
    
    protected $table = 'dealer_types';

    protected $fillable = [
        
        'name',
        'status',
        'is_delete'
    ];
}
