<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Dealers extends Model
{
    use HasFactory,Notifiable;
    
    protected $table = 'dealers';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'addressID',
        'status',
        'Contact_person',
        'opening_hours',
        'created_at',
        'dealercode',
        'updated_at'
    ];
}
