<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Interfaces\EmployeeRepositoryInterface;

class EmployeeController extends Controller
{
    public function __construct(
        private EmployeeRepositoryInterface $employeeRepository
    ) {}
    
    public function index()
    {
        $employees = $this->employeeRepository->getAll();

        return EmployeeResource::collection($employees)
            ->additional(['status' => 'success']);
    }
}