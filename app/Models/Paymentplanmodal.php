<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Paymentplanmodal extends Model
{
    use HasFactory,Notifiable;
    
    protected $table = 'payment_plan';

    protected $fillable = [
        'name',
        'iorder',
        'status',
        'created_at',
        'updated_at',
        'ibankID',
        'client_id',
        'min_max_status',
        'min_value',
        'max_value',
        'merchant_id',
        'api_password',
        'commission'
    ];
}
