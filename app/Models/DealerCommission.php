<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DealerCommission extends Model
{
    use HasFactory,Notifiable;
    
    protected $table = 'dealer_commissions';

    protected $fillable = [
        'commission',
        'date',
        'dealerID',
        'is_delete',
        'created_at',
        'updated_at',
        'status'
    ];
}