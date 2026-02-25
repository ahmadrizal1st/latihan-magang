<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name'];

    // One to Many
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}