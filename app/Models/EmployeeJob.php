<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeJob extends Model
{
    protected $fillable = ['name'];

    // One to Many
    public function employees()
    {
        /** Jika tidak difenisikan foreign key ('job_id'), maka akan error
         * Laravel akan membaca column employees.employee_job_id
         * Karena nama column employees.employee_job_id sama dengan nama column employee_jobs.id
         */
        return $this->hasMany(Employee::class, 'job_id');
    }
}