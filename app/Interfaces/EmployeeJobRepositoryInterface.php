<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface EmployeeJobRepositoryInterface
{
    public function getAll(): Collection;
}