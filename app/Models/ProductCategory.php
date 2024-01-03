<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductCategory extends Model
{
    use HasFactory,Notifiable;
    
    protected $table = 'product_category';

    protected $fillable = [
        'name',
        'code',
        'status',
        'created_at',
        'updated_at',
        'is_delete'
    ];
}
