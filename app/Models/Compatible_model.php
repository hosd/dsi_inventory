<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Compatible_model extends Model
{
    use HasFactory,Notifiable;
    
     protected $table = 'compatible_models';

    protected $fillable = [
        
        'productID',
        'modelID',
    ];
}
