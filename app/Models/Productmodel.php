<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Productmodel extends Model
{
    use HasFactory,Notifiable;
    
    protected $table = 'product';

    protected $fillable = [
        'name',
        'label_name',
        'productcode',
        'status',
        'designname',
        'designcode',
        'tyresize',
        'product_category',
        'product_subcategory',
        'unitprice',
        'customer_des',
        'product_des',
        'created_at',
        'updated_at',
        'featured',
        'bestseller',
        'isTyreorTube',
        'urlname',
        'width',
        'profile',
        'rim',
        'product_group',
        'product_group_val',
        'discount',
        'compatible_models',
        'compatible_makes',
        'master_group'
    ];
}
