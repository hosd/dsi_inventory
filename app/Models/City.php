<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class City extends Model
{
    use HasFactory,Notifiable;
    
    protected $table = 'cities';

    protected $fillable = [
        
        'city_name_en',
        'status',
        'province_id',
        'district_id'
    ];
}
