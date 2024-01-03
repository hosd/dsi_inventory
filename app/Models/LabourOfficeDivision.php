<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabourOfficeDivision extends Model
{
    use HasFactory;

    protected $table = 'labour_offices_divisions';
    public $timestamps = true;


    protected $fillable = [
        'office_name_en',
        'office_name_sin',
        'office_name_tam',
        'address',
        'tel',
        'fax',
        'email',
        'letter_head',
        'province_id',
        'district_id',
        'city_id',
        'office_type_id',
        'status'
    ];

    public function provinces()
    {
        return $this->belongsTo('App\Province', 'province_id', 'id');
    }

    public function districts()
    {
        return $this->belongsTo('App\District', 'district_id', 'id');
    }

    public function cities()
    {
        return $this->belongsTo('App\City', 'city_id', 'id');
    }

    public function officetypes()
    {
        return $this->belongsTo('App\Models\OfficeType', 'office_type_id', 'id');
    }
}
