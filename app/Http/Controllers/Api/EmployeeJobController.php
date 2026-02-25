<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\EmployeeJobResource;
use App\Http\Controllers\Controller;
use App\Interfaces\EmployeeJobRepositoryInterface;

class EmployeeJobController extends Controller
{
    public function __construct(
        private EmployeeJobRepositoryInterface $employeeRepository
    ) {}
    
    public function index()
    {
        $employees = $this->employeeRepository->getAll();

        return EmployeeJobResource::collection($employees)
            ->additional(['status' => 'success']);
    }
}