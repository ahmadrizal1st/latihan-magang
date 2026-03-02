<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'company_logo',
        'company_name',
        'company_address',
        'company_province_id',
        'company_city_id',
        'company_district_id',
        'company_village_id',
        'company_post_code',
        'company_phone',
        'company_website',
        'company_email',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'company_province_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'company_city_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'company_district_id');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'company_village_id');
    }}