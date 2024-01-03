<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Dealeruser extends Model
{
    use HasFactory,Notifiable;
    
    protected $table = 'dealer_users';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'status',
        'dealerID',
        'created_at',
        'password',
        'roleID',
        'updated_at'
    ];
}
