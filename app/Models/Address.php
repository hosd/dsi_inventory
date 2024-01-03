<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Address extends Model
{
    use HasFactory,Notifiable;
    
    protected $table = 'address';

    protected $fillable = [
        'vNo',
        'vAddressline1',
        'vAddressline2',
        'districtID',
        'provinceID',
        'cityID',
        'created_at',
        'updated_at'
    ];
}
