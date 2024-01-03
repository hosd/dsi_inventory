<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class District extends Model
{
    use HasFactory,Notifiable;
    
    protected $table = 'districts';

    protected $fillable = [
        
        'district_name_en',
        'status',
        'province_id'
    ];
}
