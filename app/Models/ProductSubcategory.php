<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductSubcategory extends Model
{
    use HasFactory,Notifiable;
    
    protected $table = 'product_subcategory';

    protected $fillable = [
        'category_id',
        'name',
        'code',
        'status',
        'created_at',
        'updated_at',
        'is_delete'
    ];
}
