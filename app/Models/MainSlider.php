<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSlider extends Model
{
    use HasFactory;

    protected $table = 'main_sliders';
    public $timestamps = true;

    protected $fillable = [
        'image', 
        'heading_1_en',
        'heading_1_si', 
        'heading_1_ta', 
        'heading_2_en', 
        'heading_2_si', 
        'heading_2_ta', 
        'caption_en', 
        'caption_si', 
        'caption_ta', 
        'url', 
        'status', 
        'is_delete'
    ];
}
