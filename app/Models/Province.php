<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['name'];

    /**
     * Get all of the cities for the province.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    /**
     * Get all of the districts for the province.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function districts()
    {
        return $this->hasManyThrough(District::class, City::class);
    }

    /**
     * Get all of the villages for the province through cities and districts.
     *
     * @return \Staudenmeir\EloquentHasManyDeep\HasManyDeep
     */
    public function villages()
    {
        return $this->hasManyDeep(Village::class, [City::class, District::class]);
    }

    /**
     * Get all of the employees for the province.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}