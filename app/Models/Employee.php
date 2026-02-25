<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'city_id',
        'job_id', 
    ];

    // Belongs to city
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Belongs to job
    public function job()
    {
        return $this->belongsTo(EmployeeJob::class);
    }
}