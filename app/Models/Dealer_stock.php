<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Dealer_stock extends Model
{
    use HasFactory,Notifiable;
    
    protected $table = 'dealer_stock';

    protected $fillable = [
        'categoryID',
        'productcode',
        'quantity',
        'reorder_quantity',
        'dealerID',
        'userID',
        'created_at',
        'updated_at',
        'status'
    ];
}
